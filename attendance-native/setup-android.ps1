# setup-android.ps1
# Run from the attendance-native/ folder after installing Node deps:
#   npm install
#   .\setup-android.ps1
#
# Prerequisites: Android Studio + SDK, Java JDK 17+, npx in PATH

Set-StrictMode -Version Latest
$ErrorActionPreference = "Stop"

$PluginSrc  = Join-Path $PSScriptRoot "android-plugin"
$AndroidSrc = Join-Path $PSScriptRoot "android\app\src\main\java\com\creativlab\attendance"

Write-Host "[1/4] Adding Capacitor Android platform..." -ForegroundColor Cyan
npx cap add android

Write-Host "[2/4] Syncing web assets to Android..." -ForegroundColor Cyan
npx cap sync android

Write-Host "[3/4] Copying plugin Java files..." -ForegroundColor Cyan
New-Item -ItemType Directory -Force -Path $AndroidSrc | Out-Null
Copy-Item "$PluginSrc\WifiInfoPlugin.java"         $AndroidSrc -Force
Copy-Item "$PluginSrc\AttendanceService.java"      $AndroidSrc -Force
Copy-Item "$PluginSrc\BootReceiver.java"           $AndroidSrc -Force
Copy-Item "$PluginSrc\BackgroundServicePlugin.java" $AndroidSrc -Force
Write-Host "  Plugin files copied to $AndroidSrc" -ForegroundColor Green

Write-Host "[4/4] Patching AndroidManifest.xml..." -ForegroundColor Cyan
$manifestPath = Join-Path $PSScriptRoot "android\app\src\main\AndroidManifest.xml"
$manifest = Get-Content $manifestPath -Raw

# Add permissions before closing </manifest>
$perms = @"
    <uses-permission android:name="android.permission.ACCESS_WIFI_STATE"/>
    <uses-permission android:name="android.permission.ACCESS_FINE_LOCATION"/>
    <uses-permission android:name="android.permission.ACCESS_NETWORK_STATE"/>
    <uses-permission android:name="android.permission.FOREGROUND_SERVICE"/>
    <uses-permission android:name="android.permission.FOREGROUND_SERVICE_LOCATION"/>
    <uses-permission android:name="android.permission.RECEIVE_BOOT_COMPLETED"/>
    <uses-permission android:name="android.permission.INTERNET"/>
"@
if ($manifest -notmatch "ACCESS_WIFI_STATE") {
    $manifest = $manifest -replace '<uses-permission android:name="android.permission.INTERNET"/>', "$perms"
}

# Add service + receiver before closing </application>
$serviceDecl = @"

        <!-- Attendance background service -->
        <service
            android:name=".AttendanceService"
            android:enabled="true"
            android:exported="false"
            android:foregroundServiceType="location"/>

        <receiver
            android:name=".BootReceiver"
            android:enabled="true"
            android:exported="true">
            <intent-filter>
                <action android:name="android.intent.action.BOOT_COMPLETED"/>
                <action android:name="android.intent.action.MY_PACKAGE_REPLACED"/>
            </intent-filter>
        </receiver>
"@
if ($manifest -notmatch "AttendanceService") {
    $manifest = $manifest -replace '</application>', "$serviceDecl`n    </application>"
}

Set-Content $manifestPath $manifest -Encoding UTF8
Write-Host "  AndroidManifest.xml updated" -ForegroundColor Green

Write-Host ""
Write-Host "========================================" -ForegroundColor Yellow
Write-Host "MANUAL STEP: Open MainActivity.java and" -ForegroundColor Yellow
Write-Host "add these to the init() method:" -ForegroundColor Yellow
Write-Host ""
Write-Host "  import com.creativlab.attendance.WifiInfoPlugin;" -ForegroundColor Cyan
Write-Host "  import com.creativlab.attendance.BackgroundServicePlugin;" -ForegroundColor Cyan
Write-Host ""
Write-Host "  add(WifiInfoPlugin.class);" -ForegroundColor Cyan
Write-Host "  add(BackgroundServicePlugin.class);" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Yellow
Write-Host ""
Write-Host "Done! Run: npx cap open android" -ForegroundColor Green
Write-Host "Then build APK via: Build > Generate Signed Bundle/APK" -ForegroundColor Green
