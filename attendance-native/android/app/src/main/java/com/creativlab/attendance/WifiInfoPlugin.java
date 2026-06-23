// FILE DESTINATION (after npx cap add android):
// android/app/src/main/java/com/creativlab/attendance/WifiInfoPlugin.java
//
// ALSO: register in MainActivity.java → add(WifiInfoPlugin.class) in onCreate
// ALSO: add permission to AndroidManifest.xml:
//   <uses-permission android:name="android.permission.ACCESS_WIFI_STATE"/>
//   <uses-permission android:name="android.permission.ACCESS_FINE_LOCATION"/>
//   <uses-permission android:name="android.permission.ACCESS_NETWORK_STATE"/>

package com.creativlab.attendance;

import android.content.Context;
import android.net.wifi.WifiInfo;
import android.net.wifi.WifiManager;
import com.getcapacitor.JSObject;
import com.getcapacitor.Plugin;
import com.getcapacitor.PluginCall;
import com.getcapacitor.PluginMethod;
import com.getcapacitor.annotation.CapacitorPlugin;

@CapacitorPlugin(name = "WifiInfo")
public class WifiInfoPlugin extends Plugin {

    @PluginMethod
    public void getSSID(PluginCall call) {
        try {
            WifiManager wm = (WifiManager) getContext()
                .getApplicationContext()
                .getSystemService(Context.WIFI_SERVICE);

            WifiInfo info = wm.getConnectionInfo();
            String raw  = (info != null) ? info.getSSID() : null;
            // Android wraps SSID in quotes; remove them
            String ssid = (raw != null) ? raw.replace("\"", "") : null;

            // Android returns these strings when SSID is unavailable
            if ("<unknown ssid>".equals(ssid) || "0x".equals(ssid) || "".equals(ssid)) {
                ssid = null;
            }

            JSObject ret = new JSObject();
            ret.put("ssid", ssid != null ? ssid : JSObject.NULL);
            call.resolve(ret);
        } catch (Exception e) {
            call.reject("WIFI_ERROR", e.getMessage(), e);
        }
    }
}
