import { _electron as electron } from 'playwright-core';
import path from 'path';
import fs from 'fs';
import { fileURLToPath } from 'url';

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const EXE = path.join(__dirname, 'dist-windows', 'win-unpacked', 'CreativLab Attendance.exe');
const SHOTS = path.join(__dirname, 'test-screenshots');
fs.mkdirSync(SHOTS, { recursive: true });

async function shot(page, name) {
  const f = path.join(SHOTS, name + '.png');
  await page.screenshot({ path: f });
  console.log('  screenshot:', f);
}

async function run() {
  console.log('Launching EXE:', EXE);
  const app = await electron.launch({
    executablePath: EXE,
    args: ['--no-sandbox'],
    timeout: 30_000,
  });

  console.log('Waiting for window...');
  const page = await app.firstWindow();
  await page.waitForLoadState('domcontentloaded');
  await new Promise(r => setTimeout(r, 4000)); // let JS boot

  console.log('Window URL:', page.url());
  console.log('All windows:', app.windows().map(w => w.url()));

  // Screenshot: initial state
  await shot(page, '01-boot');

  // Read visible text to detect which screen loaded
  const bodyText = await page.evaluate(() => document.body.innerText.substring(0, 300));
  console.log('Body text (first 300 chars):\n', bodyText);

  // Check which screen is active
  const activeScreen = await page.evaluate(() => {
    const active = document.querySelector('.screen.active');
    return active ? active.id : 'none';
  });
  console.log('Active screen:', activeScreen);

  // Check Wi-Fi badge (proves preload injected window.electron)
  const wifiEl = await page.evaluate(() => {
    const el = document.getElementById('wifiBadge');
    return el ? { display: el.style.display, text: el.textContent } : null;
  });
  console.log('Wi-Fi badge:', wifiEl);

  // Check platform badge
  const platformBadge = await page.evaluate(() => {
    const el = document.getElementById('platformBadge');
    return el ? { display: el.style.display, text: el.textContent } : null;
  });
  console.log('Platform badge:', platformBadge);

  // Check window.electron is available
  const electronBridge = await page.evaluate(() => typeof window.electron);
  console.log('window.electron type:', electronBridge);

  // Check APP_CONFIG
  const appConfig = await page.evaluate(() => window.APP_CONFIG || null);
  console.log('APP_CONFIG:', appConfig);

  // If on register screen, screenshot it
  if (activeScreen === 'screen-register') {
    console.log('→ Registration screen shown (first-time device)');
    await shot(page, '02-register');
  } else if (activeScreen === 'screen-home') {
    console.log('→ Home screen (device already registered)');
    await shot(page, '02-home');
    // Test Wi-Fi detect button in settings
    await page.evaluate(() => document.querySelector('[onclick="showSettings()"]')?.click());
    await new Promise(r => setTimeout(r, 500));
    await shot(page, '03-settings');
  }

  console.log('\nAll tests passed. Closing app...');
  await app.close();
  console.log('Done. Screenshots in:', SHOTS);
}

run().catch(e => {
  console.error('TEST FAILED:', e.message);
  process.exit(1);
});
