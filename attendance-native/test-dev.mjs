// Test via dev mode (npx electron .) — no asar integrity needed
import { _electron as electron } from 'playwright-core';
import path from 'path';
import fs from 'fs';
import { fileURLToPath } from 'url';

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const APP_DIR   = __dirname;
const ELECTRON  = path.join(APP_DIR, 'node_modules', 'electron', 'dist', 'electron.exe');
const SHOTS     = path.join(APP_DIR, 'test-screenshots');
fs.mkdirSync(SHOTS, { recursive: true });

async function shot(page, name) {
  const f = path.join(SHOTS, name + '.png');
  await page.screenshot({ path: f });
  console.log('  screenshot:', f);
}

async function run() {
  console.log('Launching via dev (electron .):', ELECTRON);
  const app = await electron.launch({
    executablePath: ELECTRON,
    args: ['--no-sandbox', APP_DIR],
    timeout: 30_000,
  });

  const page = await app.firstWindow();
  await page.waitForLoadState('domcontentloaded');
  await new Promise(r => setTimeout(r, 3000));

  // Clear localStorage so boot flow starts fresh (no device linked)
  await page.evaluate(() => localStorage.clear());
  await page.reload();
  await page.waitForLoadState('domcontentloaded');
  await new Promise(r => setTimeout(r, 4000));

  console.log('\n── Fresh boot (no device linked) ──');

  // 1. Should land on devices screen
  const activeScreen = await page.evaluate(() => document.querySelector('.screen.active')?.id);
  console.log('Active screen:', activeScreen, activeScreen === 'screen-devices' ? '✅' : '❌ expected screen-devices');

  // 2. window.electron bridge keys
  const bridgeKeys = await page.evaluate(() => Object.keys(window.electron || {}));
  console.log('window.electron keys:', bridgeKeys.join(', '));

  const hasNew = ['scanNetworkFull','getNetworkInfo'].every(k => bridgeKeys.includes(k));
  console.log('New IPC methods present:', hasNew ? '✅' : '❌');

  // 3. Devices scan info text
  await new Promise(r => setTimeout(r, 3000)); // let scan finish
  const scanInfo = await page.evaluate(() => document.getElementById('devicesScanInfo')?.textContent);
  console.log('Devices scan info:', scanInfo);

  const deviceCards = await page.evaluate(() => document.querySelectorAll('.device-card').length);
  console.log('Device cards rendered:', deviceCards, deviceCards > 0 ? '✅' : '⚠️ 0 devices found');

  await shot(page, '01-devices-fresh');

  // 4. Nav buttons clickable — check Home
  await page.evaluate(() => {
    const btns = [...document.querySelectorAll('#screen-devices .nav-btn')];
    btns.find(b => b.textContent.includes('Home'))?.click();
  });
  await new Promise(r => setTimeout(r, 800));
  const afterHome = await page.evaluate(() => document.querySelector('.screen.active')?.id);
  console.log('\nAfter clicking Home from Devices:', afterHome, afterHome === 'screen-home' ? '✅' : '❌');
  await shot(page, '02-home');

  // 5. Navigate to My Status
  await page.evaluate(() => {
    const btns = [...document.querySelectorAll('#screen-home .nav-btn')];
    btns.find(b => b.textContent.includes('My Status'))?.click();
  });
  await new Promise(r => setTimeout(r, 800));
  const afterStatus = await page.evaluate(() => document.querySelector('.screen.active')?.id);
  console.log('After clicking My Status:', afterStatus, afterStatus === 'screen-mystatus' ? '✅' : '❌');
  await shot(page, '03-mystatus');

  // 6. Back to Home
  await page.evaluate(() => {
    const btns = [...document.querySelectorAll('#screen-mystatus .nav-btn')];
    btns.find(b => b.textContent.includes('Home'))?.click();
  });
  await new Promise(r => setTimeout(r, 800));
  const backHome = await page.evaluate(() => document.querySelector('.screen.active')?.id);
  console.log('After clicking Home from My Status:', backHome, backHome === 'screen-home' ? '✅' : '❌');

  // 7. Inject device and reload — should go to Home
  await page.evaluate(() => {
    localStorage.setItem('cl_device', JSON.stringify({
      fingerprint: 'test-fp-123',
      teamId: 1,
      teamName: 'Test User',
      role: 'Developer'
    }));
    localStorage.setItem('office_ssid', 'CreativLab-Office');
  });
  await page.reload();
  await page.waitForLoadState('domcontentloaded');
  await new Promise(r => setTimeout(r, 4000));

  console.log('\n── With device linked ──');
  const withDevice = await page.evaluate(() => document.querySelector('.screen.active')?.id);
  console.log('Active screen:', withDevice, withDevice === 'screen-home' ? '✅' : '❌ expected screen-home');
  await shot(page, '04-home-with-device');

  // 8. Settings screen
  await page.evaluate(() => {
    const btns = [...document.querySelectorAll('#screen-home .nav-btn')];
    btns.find(b => b.textContent.includes('Settings'))?.click();
  });
  await new Promise(r => setTimeout(r, 800));
  const settingsScreen = await page.evaluate(() => document.querySelector('.screen.active')?.id);
  console.log('After clicking Settings:', settingsScreen, settingsScreen === 'screen-settings' ? '✅' : '❌');
  await shot(page, '05-settings');

  console.log('\nAll checks done.');
  await app.close();
}

run().catch(e => { console.error('FAILED:', e.message); process.exit(1); });
