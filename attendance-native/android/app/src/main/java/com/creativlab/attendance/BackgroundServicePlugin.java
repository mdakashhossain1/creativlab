// FILE DESTINATION (after npx cap add android):
// android/app/src/main/java/com/creativlab/attendance/BackgroundServicePlugin.java
//
// Capacitor plugin that lets app.js start/stop the foreground service and
// persist config (API base, office SSID, device fingerprint) to SharedPrefs
// so the Java service can read them even when the WebView is not running.
//
// Register in MainActivity.java → add(BackgroundServicePlugin.class)

package com.creativlab.attendance;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Build;
import com.getcapacitor.JSObject;
import com.getcapacitor.Plugin;
import com.getcapacitor.PluginCall;
import com.getcapacitor.PluginMethod;
import com.getcapacitor.annotation.CapacitorPlugin;

@CapacitorPlugin(name = "BackgroundService")
public class BackgroundServicePlugin extends Plugin {

    private static final String PREFS = "attendance_prefs";

    @PluginMethod
    public void start(PluginCall call) {
        Intent svc = new Intent(getContext(), AttendanceService.class);
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.O) {
            getContext().startForegroundService(svc);
        } else {
            getContext().startService(svc);
        }
        call.resolve();
    }

    @PluginMethod
    public void stop(PluginCall call) {
        getContext().stopService(new Intent(getContext(), AttendanceService.class));
        call.resolve();
    }

    // Save key runtime values so the Java service can use them without a WebView
    @PluginMethod
    public void savePrefs(PluginCall call) {
        SharedPreferences.Editor ed = getContext()
            .getSharedPreferences(PREFS, Context.MODE_PRIVATE).edit();

        if (call.hasOption("apiBase"))           ed.putString("api_base",           call.getString("apiBase"));
        if (call.hasOption("officeSSID"))        ed.putString("office_ssid",        call.getString("officeSSID"));
        if (call.hasOption("deviceFingerprint")) ed.putString("device_fingerprint", call.getString("deviceFingerprint"));
        ed.apply();
        call.resolve();
    }

    @PluginMethod
    public void getPrefs(PluginCall call) {
        SharedPreferences p = getContext().getSharedPreferences(PREFS, Context.MODE_PRIVATE);
        JSObject ret = new JSObject();
        ret.put("apiBase",           p.getString("api_base",           ""));
        ret.put("officeSSID",        p.getString("office_ssid",        ""));
        ret.put("deviceFingerprint", p.getString("device_fingerprint", ""));
        call.resolve(ret);
    }
}
