# Run this ONCE on each Windows PC to trust the CreativLab Attendance certificate.
# After this, the installer will never show a SmartScreen warning on this machine.
# Must be run as Administrator.

$certFile = Join-Path $PSScriptRoot "electron\icons\codesign.cer"

if (-not (Test-Path $certFile)) {
  Write-Host "ERROR: codesign.cer not found at $certFile" -ForegroundColor Red
  exit 1
}

try {
  # Add to Trusted Publishers (removes SmartScreen warning for our signed apps)
  certutil -addstore "TrustedPublisher" $certFile | Out-Null
  # Add to Root CA store (removes any certificate chain warning)
  certutil -addstore "Root" $certFile | Out-Null
  Write-Host "Done! CreativLab Attendance is now trusted on this PC." -ForegroundColor Green
  Write-Host "You can now install the app without any Windows warning." -ForegroundColor Green
} catch {
  Write-Host "Failed: $_" -ForegroundColor Red
  Write-Host "Make sure you are running this as Administrator." -ForegroundColor Yellow
}

pause
