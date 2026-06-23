// FILE DESTINATION (after npx cap add android):
// android/app/src/main/java/com/creativlab/attendance/AttendanceService.java
//
// Foreground service that keeps the app alive in the background on Android.
// Runs a Wi-Fi polling loop every 30 seconds, calling check-in/out API automatically.
//
// AndroidManifest.xml additions (inside <application>):
//   <service
//       android:name=".AttendanceService"
//       android:enabled="true"
//       android:exported="false"
//       android:foregroundServiceType="location"/>
//
// AndroidManifest.xml permissions:
//   <uses-permission android:name="android.permission.FOREGROUND_SERVICE"/>
//   <uses-permission android:name="android.permission.FOREGROUND_SERVICE_LOCATION"/>
//   <uses-permission android:name="android.permission.ACCESS_WIFI_STATE"/>
//   <uses-permission android:name="android.permission.ACCESS_FINE_LOCATION"/>
//   <uses-permission android:name="android.permission.INTERNET"/>
//   <uses-permission android:name="android.permission.RECEIVE_BOOT_COMPLETED"/>

package com.creativlab.attendance;

import android.app.Notification;
import android.app.NotificationChannel;
import android.app.NotificationManager;
import android.app.PendingIntent;
import android.app.Service;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.net.wifi.WifiInfo;
import android.net.wifi.WifiManager;
import android.os.Build;
import android.os.Handler;
import android.os.IBinder;
import android.os.Looper;
import androidx.core.app.NotificationCompat;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.nio.charset.StandardCharsets;

public class AttendanceService extends Service {

    private static final String  CHANNEL_ID   = "attendance_fg";
    private static final int     NOTIF_ID     = 1001;
    private static final long    POLL_MS      = 30_000L;
    private static final long    GRACE_MS     = 300_000L; // 5 min checkout grace

    private Handler  handler;
    private String   lastSSID        = null;
    private long     officeLeftAt    = -1;
    private boolean  scheduledOut    = false;
    private SharedPreferences prefs;

    @Override
    public void onCreate() {
        super.onCreate();
        handler = new Handler(Looper.getMainLooper());
        prefs   = getSharedPreferences("attendance_prefs", Context.MODE_PRIVATE);
        createNotificationChannel();
        startForeground(NOTIF_ID, buildNotification("Running in background…"));
        scheduleLoop();
    }

    @Override
    public int onStartCommand(Intent intent, int flags, int startId) {
        return START_STICKY; // restart if killed
    }

    @Override
    public IBinder onBind(Intent intent) { return null; }

    // ── Poll loop ─────────────────────────────────────────────────
    private void scheduleLoop() {
        handler.postDelayed(() -> {
            pollWifi();
            scheduleLoop();
        }, POLL_MS);
    }

    private void pollWifi() {
        String ssid   = getCurrentSSID();
        String office = prefs.getString("office_ssid", "");
        String fp     = prefs.getString("device_fingerprint", "");
        String api    = prefs.getString("api_base", "https://creativlab.in/api");

        if (fp.isEmpty() || office.isEmpty()) return;

        boolean atOffice = office.equals(ssid);

        if (atOffice && !office.equals(lastSSID)) {
            // Just arrived at office → cancel grace, check in
            officeLeftAt = -1;
            scheduledOut = false;
            apiPost(api + "/attendance/checkin",
                "{\"device_fingerprint\":\"" + fp + "\",\"source\":\"wifi\"}");
            updateNotification("Office Wi-Fi connected ✓");
        } else if (!atOffice && office.equals(lastSSID)) {
            // Just left office → start 5-min grace timer
            officeLeftAt = System.currentTimeMillis();
            updateNotification("Left office Wi-Fi – checking out in 5 min…");
        } else if (!atOffice && officeLeftAt > 0 && !scheduledOut) {
            if (System.currentTimeMillis() - officeLeftAt >= GRACE_MS) {
                scheduledOut = true;
                apiPost(api + "/attendance/checkout",
                    "{\"device_fingerprint\":\"" + fp + "\"}");
                updateNotification("Auto checked out");
            }
        }

        lastSSID = ssid;
    }

    // ── Wi-Fi SSID ────────────────────────────────────────────────
    private String getCurrentSSID() {
        try {
            WifiManager wm = (WifiManager) getApplicationContext()
                .getSystemService(Context.WIFI_SERVICE);
            WifiInfo info = wm.getConnectionInfo();
            if (info == null) return null;
            String raw = info.getSSID().replace("\"", "");
            return (raw.startsWith("<") || raw.isEmpty()) ? null : raw;
        } catch (Exception e) { return null; }
    }

    // ── Minimal HTTP POST (no external deps) ──────────────────────
    private void apiPost(String urlStr, String jsonBody) {
        new Thread(() -> {
            try {
                URL url = new URL(urlStr);
                HttpURLConnection conn = (HttpURLConnection) url.openConnection();
                conn.setRequestMethod("POST");
                conn.setRequestProperty("Content-Type", "application/json");
                conn.setRequestProperty("Accept", "application/json");
                conn.setConnectTimeout(10_000);
                conn.setReadTimeout(10_000);
                conn.setDoOutput(true);
                byte[] body = jsonBody.getBytes(StandardCharsets.UTF_8);
                try (OutputStream os = conn.getOutputStream()) { os.write(body); }
                conn.getResponseCode(); // fire and forget
                conn.disconnect();
            } catch (Exception ignored) {}
        }).start();
    }

    // ── Notification ──────────────────────────────────────────────
    private void createNotificationChannel() {
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.O) {
            NotificationChannel ch = new NotificationChannel(
                CHANNEL_ID, "Attendance Background", NotificationManager.IMPORTANCE_LOW);
            ch.setDescription("Monitors Wi-Fi for automatic attendance");
            getSystemService(NotificationManager.class).createNotificationChannel(ch);
        }
    }

    private Notification buildNotification(String text) {
        Intent intent = new Intent(this, MainActivity.class);
        PendingIntent pi = PendingIntent.getActivity(this, 0, intent,
            PendingIntent.FLAG_UPDATE_CURRENT | PendingIntent.FLAG_IMMUTABLE);

        return new NotificationCompat.Builder(this, CHANNEL_ID)
            .setContentTitle("CreativLab Attendance")
            .setContentText(text)
            .setSmallIcon(android.R.drawable.ic_dialog_info)
            .setContentIntent(pi)
            .setOngoing(true)
            .setPriority(NotificationCompat.PRIORITY_LOW)
            .build();
    }

    private void updateNotification(String text) {
        NotificationManager nm = (NotificationManager) getSystemService(NOTIFICATION_SERVICE);
        nm.notify(NOTIF_ID, buildNotification(text));
    }
}
