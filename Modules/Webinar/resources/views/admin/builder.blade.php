<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Builder — {{ $webinar->title }}</title>

    <link rel="stylesheet" href="https://unpkg.com/grapesjs/dist/css/grapes.min.css">
    <link rel="stylesheet" href="{{ asset('backend/css/font-awesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('global/toastr/toastr.min.css') }}">

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; background: #1a1a2e; color: #eee; height: 100vh; display: flex; flex-direction: column; }

        /* ── Top Toolbar ── */
        #wb-toolbar {
            display: flex; align-items: center; gap: 10px;
            background: #16213e; padding: 8px 16px;
            border-bottom: 2px solid #0f3460; flex-shrink: 0; flex-wrap: wrap;
        }
        #wb-toolbar .wb-brand { font-weight: 700; font-size: 14px; color: #818cf8; margin-right: 8px; white-space: nowrap; }
        #wb-toolbar .wb-sep { width: 1px; height: 28px; background: #334155; }
        .wb-btn {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 6px 14px; border-radius: 6px; border: none; cursor: pointer;
            font-size: 13px; font-weight: 600; transition: opacity .15s;
        }
        .wb-btn:hover { opacity: .85; }
        .wb-btn-save   { background: #6366f1; color: #fff; }
        .wb-btn-prev   { background: #0ea5e9; color: #fff; }
        .wb-btn-undo   { background: #334155; color: #e2e8f0; }
        .wb-btn-redo   { background: #334155; color: #e2e8f0; }
        .wb-btn-clear  { background: #dc2626; color: #fff; }
        .wb-btn-back   { background: #475569; color: #fff; text-decoration: none; }
        #wb-status     { font-size: 12px; color: #94a3b8; margin-left: auto; white-space: nowrap; }
        #wb-device-btns button { background: #334155; border: none; color: #e2e8f0; padding: 5px 10px; border-radius: 4px; cursor: pointer; font-size: 12px; margin: 0 2px; }
        #wb-device-btns button.active { background: #6366f1; }

        /* ── GrapesJS shell ── */
        #gjs { flex: 1; overflow: hidden; }
        .gjs-one-bg    { background: #16213e; }
        .gjs-two-color { color: #94a3b8; }
        .gjs-three-bg  { background: #0f3460; }
        .gjs-four-color, .gjs-four-color-h:hover { color: #818cf8; }

        /* Make panels look good */
        .gjs-pn-panel { padding: 4px; }
        .gjs-block-category .gjs-title { font-size: 11px; font-weight: 700; letter-spacing: .5px; text-transform: uppercase; color: #818cf8; }
        .gjs-block { border-radius: 6px; border-color: #1e3a5f; padding: 8px 4px; }
        .gjs-block:hover { border-color: #6366f1; }
        .gjs-block__label { font-size: 11px; color: #cbd5e1; }
        .gjs-block-media { display: flex; align-items: center; justify-content: center; height: 48px; }
        .gjs-block-media i { font-size: 36px; color: #64748b; transition: color .2s; line-height: 1; }
        .gjs-block:hover .gjs-block-media i { color: #818cf8; }
    </style>
</head>
<body>

{{-- ─── Top Toolbar ─────────────────────────────────────────────────────── --}}
<div id="wb-toolbar">
    <span class="wb-brand"><i class="fas fa-magic"></i> Webinar Builder</span>
    <div class="wb-sep"></div>
    <a href="{{ route('admin.webinar.index') }}" class="wb-btn wb-btn-back"><i class="fas fa-arrow-left"></i> Back</a>
    <button class="wb-btn wb-btn-undo" id="btnUndo" title="Undo"><i class="fas fa-undo"></i></button>
    <button class="wb-btn wb-btn-redo" id="btnRedo" title="Redo"><i class="fas fa-redo"></i></button>
    <div class="wb-sep"></div>
    <div id="wb-device-btns">
        <button id="dev-desktop" class="active" title="Desktop"><i class="fas fa-desktop"></i></button>
        <button id="dev-tablet" title="Tablet"><i class="fas fa-tablet-alt"></i></button>
        <button id="dev-mobile" title="Mobile"><i class="fas fa-mobile-alt"></i></button>
    </div>
    <div class="wb-sep"></div>
    <button class="wb-btn wb-btn-clear" id="btnClear" title="Clear canvas"><i class="fas fa-trash-alt"></i> Clear</button>
    <button class="wb-btn wb-btn-save" id="btnSave"><i class="fas fa-save"></i> Save Page</button>
    <a href="{{ route('webinar.show', $webinar->slug) }}" target="_blank" class="wb-btn wb-btn-prev">
        <i class="fas fa-external-link-alt"></i> Preview
    </a>
    <span id="wb-status">Last saved: auto</span>
</div>

{{-- ─── GrapesJS Canvas ─────────────────────────────────────────────────── --}}
<div id="gjs"></div>

<script src="{{ asset('global/js/jquery-3.7.1.min.js') }}"></script>
<script src="https://unpkg.com/grapesjs/dist/grapes.min.js"></script>
<script src="https://unpkg.com/grapesjs-blocks-basic"></script>
<script src="{{ asset('global/toastr/toastr.min.js') }}"></script>

<script>
(function () {
    'use strict';

    // ── Saved page content ─────────────────────────────────────────────────
    const savedData = @json($webinar->page_data ?? '');
    const savedHtml = @json($webinar->page_html ?? '');
    const savedCss  = @json($webinar->page_css  ?? '');
    const saveUrl   = @json(route('admin.webinar.save-page', $webinar->id));
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    // ── Init GrapesJS ──────────────────────────────────────────────────────
    const editor = grapesjs.init({
        container: '#gjs',
        height: '100%',
        width: 'auto',
        storageManager: false,
        fromElement: false,
        // Keep all styles as inline attributes so getHtml() always includes them
        avoidInlineStyle: false,
        forceClass: false,
        plugins: ['gjs-blocks-basic'],
        pluginsOpts: {
            'gjs-blocks-basic': {
                blocks: ['column1', 'column2', 'column3', 'column3-7', 'text', 'link', 'image', 'video', 'map'],
                flexGrid: true,
                stylePrefix: 'gjs-',
                addBasicStyle: true,
            }
        },
        deviceManager: {
            devices: [
                { name: 'Desktop',  width: '' },
                { name: 'Tablet',   width: '768px',  widthMedia: '992px' },
                { name: 'Mobile',   width: '320px',  widthMedia: '480px' },
            ]
        },
        styleManager: {
            sectors: [
                { name: 'General',    open: true,  buildProps: ['float','display','position','top','right','left','bottom'] },
                { name: 'Dimension',  open: false, buildProps: ['width','height','max-width','min-height','margin','padding'] },
                { name: 'Typography', open: false, buildProps: ['font-family','font-size','font-weight','letter-spacing','color','line-height','text-align','text-shadow'] },
                { name: 'Background', open: false, buildProps: ['background-color','background','background-size'] },
                { name: 'Border',     open: false, buildProps: ['border','border-radius','box-shadow'] },
                { name: 'Extra',      open: false, buildProps: ['opacity','cursor','overflow','flex-direction','align-items','justify-content','flex-wrap','gap'] },
            ]
        },
        canvas: { styles: ['https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css'] },
        assetManager: { upload: false },
    });

    // ── Load saved content (project data takes priority over raw HTML/CSS) ──
    // Strip any legacy embedded <style> block from page_html before feeding to setComponents
    function stripEmbeddedStyle(html) {
        return html ? html.replace(/^<style>[\s\S]*?<\/style>/i, '').trim() : '';
    }
    const cleanSavedHtml = stripEmbeddedStyle(savedHtml);

    if (savedData) {
        try { editor.loadProjectData(JSON.parse(savedData)); }
        catch(e) { editor.setComponents(cleanSavedHtml || getDefaultPage()); editor.setStyle(savedCss || ''); }
    } else if (cleanSavedHtml) {
        editor.setComponents(cleanSavedHtml);
        editor.setStyle(savedCss || '');
    } else {
        editor.setComponents(getDefaultPage());
    }

    // ── Custom Webinar Blocks ──────────────────────────────────────────────
    const bm = editor.BlockManager;

    bm.add('wb-hero', {
        label: 'Hero Banner',
        media: '<i class="fas fa-film" style="font-size:36px;"></i>',
        category: 'Webinar',
        content: `
<section style="background:linear-gradient(135deg,#1a1a2e 0%,#16213e 50%,#0f3460 100%);padding:100px 20px;text-align:center;color:#fff;">
  <div style="max-width:800px;margin:0 auto;">
    <p style="color:#818cf8;font-size:14px;letter-spacing:3px;text-transform:uppercase;margin-bottom:16px;">Live Webinar Event</p>
    <h1 style="font-size:clamp(2rem,5vw,3.5rem);font-weight:800;line-height:1.2;margin-bottom:20px;">Your Webinar Title Goes Here</h1>
    <p style="font-size:18px;color:#94a3b8;max-width:560px;margin:0 auto 32px;">A compelling description of what attendees will learn from this session.</p>
    <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;margin-bottom:32px;">
      <span style="background:rgba(129,140,248,.15);border:1px solid #818cf8;color:#818cf8;padding:8px 18px;border-radius:20px;font-size:14px;">📅 Date & Time</span>
      <span style="background:rgba(129,140,248,.15);border:1px solid #818cf8;color:#818cf8;padding:8px 18px;border-radius:20px;font-size:14px;">⏱ Duration: 2 Hours</span>
      <span style="background:rgba(129,140,248,.15);border:1px solid #818cf8;color:#818cf8;padding:8px 18px;border-radius:20px;font-size:14px;">🌐 Online / Zoom</span>
    </div>
    <a href="#register" style="display:inline-block;background:#6366f1;color:#fff;padding:16px 40px;border-radius:8px;font-size:16px;font-weight:700;text-decoration:none;">Register Now →</a>
  </div>
</section>`,
    });

    bm.add('wb-countdown', {
        label: 'Countdown Timer',
        media: '<i class="fas fa-clock" style="font-size:36px;"></i>',
        category: 'Webinar',
        content: `
<section style="background:#f8fafc;padding:60px 20px;text-align:center;">
  <h2 style="font-size:1.5rem;color:#1e293b;margin-bottom:8px;">Webinar starts in</h2>
  <p style="color:#64748b;margin-bottom:32px;">Don't miss out — reserve your spot now!</p>
  <div id="wb-countdown" style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap;">
    <div style="background:#6366f1;color:#fff;border-radius:12px;padding:20px 28px;min-width:80px;">
      <div class="wb-cnt-num" id="cnt-days" style="font-size:2.5rem;font-weight:800;line-height:1;">00</div>
      <div style="font-size:11px;letter-spacing:2px;text-transform:uppercase;margin-top:4px;">Days</div>
    </div>
    <div style="background:#6366f1;color:#fff;border-radius:12px;padding:20px 28px;min-width:80px;">
      <div class="wb-cnt-num" id="cnt-hours" style="font-size:2.5rem;font-weight:800;line-height:1;">00</div>
      <div style="font-size:11px;letter-spacing:2px;text-transform:uppercase;margin-top:4px;">Hours</div>
    </div>
    <div style="background:#6366f1;color:#fff;border-radius:12px;padding:20px 28px;min-width:80px;">
      <div class="wb-cnt-num" id="cnt-mins" style="font-size:2.5rem;font-weight:800;line-height:1;">00</div>
      <div style="font-size:11px;letter-spacing:2px;text-transform:uppercase;margin-top:4px;">Minutes</div>
    </div>
    <div style="background:#6366f1;color:#fff;border-radius:12px;padding:20px 28px;min-width:80px;">
      <div class="wb-cnt-num" id="cnt-secs" style="font-size:2.5rem;font-weight:800;line-height:1;">00</div>
      <div style="font-size:11px;letter-spacing:2px;text-transform:uppercase;margin-top:4px;">Seconds</div>
    </div>
  </div>
</section>`,
    });

    bm.add('wb-about', {
        label: 'About Section',
        media: '<i class="fas fa-info-circle" style="font-size:36px;"></i>',
        category: 'Webinar',
        content: `
<section style="padding:80px 20px;background:#fff;">
  <div style="max-width:1100px;margin:0 auto;display:flex;gap:60px;align-items:center;flex-wrap:wrap;">
    <div style="flex:1;min-width:280px;">
      <p style="color:#6366f1;font-weight:600;font-size:13px;letter-spacing:2px;text-transform:uppercase;margin-bottom:12px;">About This Webinar</p>
      <h2 style="font-size:2rem;font-weight:800;color:#1e293b;margin-bottom:20px;line-height:1.3;">What You'll Learn From This Session</h2>
      <p style="color:#64748b;line-height:1.8;margin-bottom:20px;">Describe your webinar in detail here. What topics will be covered? Who should attend? What value will participants take away?</p>
      <ul style="list-style:none;padding:0;">
        <li style="padding:8px 0;color:#374151;display:flex;align-items:flex-start;gap:10px;"><span style="color:#6366f1;font-weight:700;">✓</span> Key learning point 1</li>
        <li style="padding:8px 0;color:#374151;display:flex;align-items:flex-start;gap:10px;"><span style="color:#6366f1;font-weight:700;">✓</span> Key learning point 2</li>
        <li style="padding:8px 0;color:#374151;display:flex;align-items:flex-start;gap:10px;"><span style="color:#6366f1;font-weight:700;">✓</span> Key learning point 3</li>
        <li style="padding:8px 0;color:#374151;display:flex;align-items:flex-start;gap:10px;"><span style="color:#6366f1;font-weight:700;">✓</span> Key learning point 4</li>
      </ul>
    </div>
    <div style="flex:1;min-width:280px;">
      <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=600&auto=format" alt="Webinar" style="width:100%;border-radius:16px;box-shadow:0 20px 60px rgba(0,0,0,.1);">
    </div>
  </div>
</section>`,
    });

    bm.add('wb-speaker', {
        label: 'Speaker Card',
        media: '<i class="fas fa-microphone" style="font-size:36px;"></i>',
        category: 'Webinar',
        content: `
<section style="padding:80px 20px;background:#f8fafc;">
  <div style="max-width:1100px;margin:0 auto;text-align:center;">
    <p style="color:#6366f1;font-weight:600;font-size:13px;letter-spacing:2px;text-transform:uppercase;margin-bottom:12px;">Meet the Speaker</p>
    <h2 style="font-size:2rem;font-weight:800;color:#1e293b;margin-bottom:48px;">Expert Instructor</h2>
    <div style="display:flex;gap:32px;justify-content:center;flex-wrap:wrap;">
      <div style="background:#fff;border-radius:20px;padding:40px 32px;max-width:320px;box-shadow:0 4px 20px rgba(0,0,0,.08);text-align:center;">
        <img src="https://ui-avatars.com/api/?name=Speaker+Name&size=120&background=6366f1&color=fff&rounded=true&bold=true" alt="Speaker" style="width:100px;height:100px;border-radius:50%;margin-bottom:20px;border:4px solid #6366f1;">
        <h3 style="font-size:1.25rem;font-weight:700;color:#1e293b;margin-bottom:4px;">Speaker Name</h3>
        <p style="color:#6366f1;font-size:14px;font-weight:600;margin-bottom:16px;">CEO / Expert Title</p>
        <p style="color:#64748b;font-size:14px;line-height:1.7;">Short bio about the speaker. Their expertise, experience, and why they're the right person to teach this topic.</p>
      </div>
    </div>
  </div>
</section>`,
    });

    bm.add('wb-schedule', {
        label: 'Schedule / Agenda',
        media: '<i class="fas fa-calendar-alt" style="font-size:36px;"></i>',
        category: 'Webinar',
        content: `
<section style="padding:80px 20px;background:#fff;">
  <div style="max-width:760px;margin:0 auto;">
    <p style="color:#6366f1;font-weight:600;font-size:13px;letter-spacing:2px;text-transform:uppercase;margin-bottom:12px;text-align:center;">Program</p>
    <h2 style="font-size:2rem;font-weight:800;color:#1e293b;margin-bottom:48px;text-align:center;">Webinar Agenda</h2>
    <div style="position:relative;">
      <div style="position:absolute;left:28px;top:0;bottom:0;width:2px;background:#e2e8f0;"></div>
      <div style="display:flex;gap:20px;align-items:flex-start;margin-bottom:32px;">
        <div style="width:56px;height:56px;border-radius:50%;background:#6366f1;color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:13px;flex-shrink:0;position:relative;z-index:1;">9:00</div>
        <div style="padding-top:10px;"><h4 style="font-size:1rem;font-weight:700;color:#1e293b;margin-bottom:4px;">Opening & Introductions</h4><p style="color:#64748b;font-size:14px;">Welcome session and speaker introduction.</p></div>
      </div>
      <div style="display:flex;gap:20px;align-items:flex-start;margin-bottom:32px;">
        <div style="width:56px;height:56px;border-radius:50%;background:#818cf8;color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:13px;flex-shrink:0;position:relative;z-index:1;">9:30</div>
        <div style="padding-top:10px;"><h4 style="font-size:1rem;font-weight:700;color:#1e293b;margin-bottom:4px;">Main Topic: Deep Dive</h4><p style="color:#64748b;font-size:14px;">Core content presentation with live examples.</p></div>
      </div>
      <div style="display:flex;gap:20px;align-items:flex-start;margin-bottom:32px;">
        <div style="width:56px;height:56px;border-radius:50%;background:#818cf8;color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:13px;flex-shrink:0;position:relative;z-index:1;">10:30</div>
        <div style="padding-top:10px;"><h4 style="font-size:1rem;font-weight:700;color:#1e293b;margin-bottom:4px;">Q&A Session</h4><p style="color:#64748b;font-size:14px;">Open floor for attendee questions.</p></div>
      </div>
      <div style="display:flex;gap:20px;align-items:flex-start;">
        <div style="width:56px;height:56px;border-radius:50%;background:#e2e8f0;color:#64748b;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:13px;flex-shrink:0;position:relative;z-index:1;">11:00</div>
        <div style="padding-top:10px;"><h4 style="font-size:1rem;font-weight:700;color:#1e293b;margin-bottom:4px;">Closing</h4><p style="color:#64748b;font-size:14px;">Wrap-up and resources shared.</p></div>
      </div>
    </div>
  </div>
</section>`,
    });

    bm.add('wb-pricing', {
        label: 'Pricing / Ticket',
        media: '<i class="fas fa-tags" style="font-size:36px;"></i>',
        category: 'Webinar',
        content: `
<section style="padding:80px 20px;background:#f8fafc;">
  <div style="max-width:1000px;margin:0 auto;text-align:center;">
    <p style="color:#6366f1;font-weight:600;font-size:13px;letter-spacing:2px;text-transform:uppercase;margin-bottom:12px;">Pricing</p>
    <h2 style="font-size:2rem;font-weight:800;color:#1e293b;margin-bottom:48px;">Choose Your Access</h2>
    <div style="display:flex;gap:24px;justify-content:center;flex-wrap:wrap;">
      <div style="background:#fff;border-radius:20px;padding:40px 32px;max-width:300px;flex:1;box-shadow:0 4px 20px rgba(0,0,0,.08);">
        <h3 style="font-size:1.1rem;font-weight:700;color:#64748b;margin-bottom:12px;">Basic</h3>
        <div style="font-size:3rem;font-weight:800;color:#1e293b;margin-bottom:4px;">Free</div>
        <p style="color:#94a3b8;margin-bottom:24px;">Live session access</p>
        <ul style="list-style:none;padding:0;margin-bottom:32px;text-align:left;">
          <li style="padding:8px 0;color:#374151;border-bottom:1px solid #f1f5f9;">✓ Live webinar access</li>
          <li style="padding:8px 0;color:#374151;border-bottom:1px solid #f1f5f9;">✓ Q&A participation</li>
          <li style="padding:8px 0;color:#94a3b8;">✗ Recording access</li>
        </ul>
        <a href="#register" style="display:block;background:#f1f5f9;color:#374151;padding:14px;border-radius:8px;font-weight:700;text-decoration:none;">Register Free</a>
      </div>
      <div style="background:linear-gradient(135deg,#6366f1,#818cf8);border-radius:20px;padding:40px 32px;max-width:300px;flex:1;box-shadow:0 20px 60px rgba(99,102,241,.3);">
        <h3 style="font-size:1.1rem;font-weight:700;color:rgba(255,255,255,.8);margin-bottom:12px;">Premium</h3>
        <div style="font-size:3rem;font-weight:800;color:#fff;margin-bottom:4px;">$49</div>
        <p style="color:rgba(255,255,255,.7);margin-bottom:24px;">Full lifetime access</p>
        <ul style="list-style:none;padding:0;margin-bottom:32px;text-align:left;">
          <li style="padding:8px 0;color:#fff;border-bottom:1px solid rgba(255,255,255,.2);">✓ Live webinar access</li>
          <li style="padding:8px 0;color:#fff;border-bottom:1px solid rgba(255,255,255,.2);">✓ Q&A participation</li>
          <li style="padding:8px 0;color:#fff;">✓ Lifetime recording</li>
        </ul>
        <a href="#register" style="display:block;background:#fff;color:#6366f1;padding:14px;border-radius:8px;font-weight:700;text-decoration:none;">Get Premium Access</a>
      </div>
    </div>
  </div>
</section>`,
    });

    bm.add('wb-faq', {
        label: 'FAQ Accordion',
        media: '<i class="fas fa-question-circle" style="font-size:36px;"></i>',
        category: 'Webinar',
        content: `
<section style="padding:80px 20px;background:#fff;">
  <div style="max-width:760px;margin:0 auto;">
    <p style="color:#6366f1;font-weight:600;font-size:13px;letter-spacing:2px;text-transform:uppercase;margin-bottom:12px;text-align:center;">FAQ</p>
    <h2 style="font-size:2rem;font-weight:800;color:#1e293b;margin-bottom:48px;text-align:center;">Frequently Asked Questions</h2>
    <details style="border:1px solid #e2e8f0;border-radius:12px;padding:0;margin-bottom:12px;overflow:hidden;">
      <summary style="padding:20px 24px;font-weight:600;color:#1e293b;cursor:pointer;list-style:none;display:flex;justify-content:space-between;">Will the webinar be recorded? <span>+</span></summary>
      <div style="padding:0 24px 20px;color:#64748b;line-height:1.7;">Yes, all registered attendees will receive a recording link within 48 hours after the event.</div>
    </details>
    <details style="border:1px solid #e2e8f0;border-radius:12px;padding:0;margin-bottom:12px;overflow:hidden;">
      <summary style="padding:20px 24px;font-weight:600;color:#1e293b;cursor:pointer;list-style:none;display:flex;justify-content:space-between;">What platform will be used? <span>+</span></summary>
      <div style="padding:0 24px 20px;color:#64748b;line-height:1.7;">We will use Zoom. The link will be sent to your registered email 24 hours before the event.</div>
    </details>
    <details style="border:1px solid #e2e8f0;border-radius:12px;padding:0;margin-bottom:12px;overflow:hidden;">
      <summary style="padding:20px 24px;font-weight:600;color:#1e293b;cursor:pointer;list-style:none;display:flex;justify-content:space-between;">Is there a refund policy? <span>+</span></summary>
      <div style="padding:0 24px 20px;color:#64748b;line-height:1.7;">Full refunds are available up to 7 days before the event. Contact our support for assistance.</div>
    </details>
  </div>
</section>`,
    });

    bm.add('wb-testimonial', {
        label: 'Testimonials',
        media: '<i class="fas fa-star" style="font-size:36px;"></i>',
        category: 'Webinar',
        content: `
<section style="padding:80px 20px;background:#f8fafc;">
  <div style="max-width:1100px;margin:0 auto;text-align:center;">
    <p style="color:#6366f1;font-weight:600;font-size:13px;letter-spacing:2px;text-transform:uppercase;margin-bottom:12px;">Testimonials</p>
    <h2 style="font-size:2rem;font-weight:800;color:#1e293b;margin-bottom:48px;">What Past Attendees Say</h2>
    <div style="display:flex;gap:24px;justify-content:center;flex-wrap:wrap;">
      <div style="background:#fff;border-radius:16px;padding:32px;max-width:320px;box-shadow:0 4px 20px rgba(0,0,0,.06);text-align:left;">
        <div style="color:#f59e0b;font-size:18px;margin-bottom:16px;">★★★★★</div>
        <p style="color:#374151;line-height:1.8;margin-bottom:20px;">"This webinar completely changed how I approach marketing. Incredibly valuable content!"</p>
        <div style="display:flex;align-items:center;gap:12px;">
          <img src="https://ui-avatars.com/api/?name=Jane+Doe&background=6366f1&color=fff&size=40&rounded=true" style="width:40px;height:40px;border-radius:50%;">
          <div><strong style="color:#1e293b;font-size:14px;">Jane Doe</strong><br><small style="color:#64748b;">Marketing Manager</small></div>
        </div>
      </div>
      <div style="background:#fff;border-radius:16px;padding:32px;max-width:320px;box-shadow:0 4px 20px rgba(0,0,0,.06);text-align:left;">
        <div style="color:#f59e0b;font-size:18px;margin-bottom:16px;">★★★★★</div>
        <p style="color:#374151;line-height:1.8;margin-bottom:20px;">"Best webinar I've attended in 2025. The practical tips were immediately actionable."</p>
        <div style="display:flex;align-items:center;gap:12px;">
          <img src="https://ui-avatars.com/api/?name=John+Smith&background=818cf8&color=fff&size=40&rounded=true" style="width:40px;height:40px;border-radius:50%;">
          <div><strong style="color:#1e293b;font-size:14px;">John Smith</strong><br><small style="color:#64748b;">Business Owner</small></div>
        </div>
      </div>
    </div>
  </div>
</section>`,
    });

    bm.add('wb-register-form', {
        label: 'Registration Form',
        media: '<i class="fas fa-clipboard-list" style="font-size:36px;"></i>',
        category: 'Webinar',
        content: `
<section id="register" style="padding:80px 20px;background:linear-gradient(135deg,#1a1a2e,#16213e);">
  <div style="max-width:520px;margin:0 auto;">
    <p style="color:#818cf8;font-weight:600;font-size:13px;letter-spacing:2px;text-transform:uppercase;margin-bottom:12px;text-align:center;">Reserve Your Spot</p>
    <h2 style="font-size:2rem;font-weight:800;color:#fff;margin-bottom:12px;text-align:center;">Register for the Webinar</h2>
    <p style="color:#94a3b8;margin-bottom:32px;text-align:center;">Fill in your details — confirmation sent to your email.</p>
    <div style="background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:20px;padding:36px;">
      <form method="POST" action="__WB_REGISTER_URL__" style="display:flex;flex-direction:column;gap:14px;">
        <input type="hidden" name="_token" value="__WB_CSRF_TOKEN__">
        <div>
          <label style="color:#cbd5e1;font-size:13px;font-weight:600;display:block;margin-bottom:6px;">Full Name *</label>
          <input type="text" name="name" required placeholder="Your full name"
            style="width:100%;padding:12px 16px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.15);border-radius:8px;color:#fff;font-size:15px;outline:none;box-sizing:border-box;">
        </div>
        <div>
          <label style="color:#cbd5e1;font-size:13px;font-weight:600;display:block;margin-bottom:6px;">Email Address *</label>
          <input type="email" name="email" required placeholder="your@email.com"
            style="width:100%;padding:12px 16px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.15);border-radius:8px;color:#fff;font-size:15px;outline:none;box-sizing:border-box;">
        </div>
        <div>
          <label style="color:#cbd5e1;font-size:13px;font-weight:600;display:block;margin-bottom:6px;">Phone Number</label>
          <input type="text" name="phone" placeholder="+1 (555) 000-0000"
            style="width:100%;padding:12px 16px;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.15);border-radius:8px;color:#fff;font-size:15px;outline:none;box-sizing:border-box;">
        </div>
        <button type="submit"
          style="width:100%;padding:14px;background:#6366f1;color:#fff;font-size:16px;font-weight:700;border:none;border-radius:8px;cursor:pointer;margin-top:4px;">
          Register Now →
        </button>
      </form>
    </div>
  </div>
</section>`,
    });

    bm.add('wb-contact-link', {
        label: 'Contact / Query',
        media: '<i class="fas fa-envelope" style="font-size:36px;"></i>',
        category: 'Webinar',
        content: `
<section style="padding:60px 20px;background:#f1f5f9;text-align:center;">
  <div style="max-width:600px;margin:0 auto;">
    <h3 style="font-size:1.5rem;font-weight:800;color:#1e293b;margin-bottom:12px;">Have Questions?</h3>
    <p style="color:#64748b;margin-bottom:28px;">Reach out to us before registering and we'll be happy to help.</p>
    <a href="/contact" style="display:inline-block;background:#6366f1;color:#fff;padding:14px 36px;border-radius:8px;font-weight:700;text-decoration:none;">Contact Us</a>
  </div>
</section>`,
    });

    bm.add('wb-video', {
        label: 'Video Embed',
        media: '<i class="fas fa-video" style="font-size:36px;"></i>',
        category: 'Webinar',
        content: `
<section style="padding:80px 20px;background:#000;">
  <div style="max-width:900px;margin:0 auto;text-align:center;">
    <h2 style="font-size:2rem;font-weight:800;color:#fff;margin-bottom:32px;">Watch the Preview</h2>
    <div style="position:relative;padding-bottom:56.25%;height:0;overflow:hidden;border-radius:16px;">
      <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ"
              style="position:absolute;top:0;left:0;width:100%;height:100%;"
              frameborder="0" allow="accelerometer;autoplay;clipboard-write;encrypted-media;gyroscope;picture-in-picture"
              allowfullscreen></iframe>
    </div>
  </div>
</section>`,
    });

    bm.add('wb-cta', {
        label: 'Call to Action',
        media: '<i class="fas fa-rocket" style="font-size:36px;"></i>',
        category: 'Webinar',
        content: `
<section style="padding:80px 20px;background:linear-gradient(135deg,#6366f1,#818cf8);text-align:center;">
  <div style="max-width:700px;margin:0 auto;">
    <h2 style="font-size:2.5rem;font-weight:800;color:#fff;margin-bottom:16px;">Don't Miss This Event!</h2>
    <p style="color:rgba(255,255,255,.85);font-size:18px;margin-bottom:40px;">Limited seats available. Register now and secure your spot.</p>
    <a href="#register" style="display:inline-block;background:#fff;color:#6366f1;padding:18px 48px;border-radius:50px;font-size:18px;font-weight:800;text-decoration:none;box-shadow:0 10px 40px rgba(0,0,0,.2);">Claim Your Seat →</a>
  </div>
</section>`,
    });

    bm.add('wb-divider', {
        label: 'Divider',
        media: '<i class="fas fa-minus" style="font-size:36px;"></i>',
        category: 'Webinar',
        content: '<hr style="border:none;border-top:2px solid #e2e8f0;margin:40px auto;max-width:200px;">',
    });

    // ── Device Buttons ─────────────────────────────────────────────────────
    document.getElementById('dev-desktop').addEventListener('click', function () {
        editor.setDevice('Desktop');
        document.querySelectorAll('#wb-device-btns button').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
    });
    document.getElementById('dev-tablet').addEventListener('click', function () {
        editor.setDevice('Tablet');
        document.querySelectorAll('#wb-device-btns button').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
    });
    document.getElementById('dev-mobile').addEventListener('click', function () {
        editor.setDevice('Mobile');
        document.querySelectorAll('#wb-device-btns button').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
    });

    // ── Undo / Redo ────────────────────────────────────────────────────────
    document.getElementById('btnUndo').addEventListener('click', () => editor.runCommand('core:undo'));
    document.getElementById('btnRedo').addEventListener('click', () => editor.runCommand('core:redo'));

    // ── Clear ──────────────────────────────────────────────────────────────
    document.getElementById('btnClear').addEventListener('click', function () {
        if (confirm('Clear the entire canvas? This cannot be undone.')) {
            editor.setComponents('');
            editor.setStyle('');
        }
    });

    // ── Save ──────────────────────────────────────────────────────────────
    function savePage(showToast) {
        // GrapesJS wraps getHtml() output in <body id="...">...</body>.
        // Strip that wrapper so page_html is raw inner content only.
        // CSS uses #id selectors — must be saved from the same getHtml() call to match.
        const rawHtml = editor.getHtml();
        const html = rawHtml.replace(/^<body[^>]*>/i, '').replace(/<\/body>\s*$/i, '').trim();
        const css  = editor.getCss();
        const data = JSON.stringify(editor.getProjectData());

        fetch(saveUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify({ html, css, data }),
        })
        .then(r => r.json())
        .then(data => {
            const now = new Date().toLocaleTimeString();
            document.getElementById('wb-status').textContent = 'Saved at ' + now;
            if (showToast) toastr.success('Page saved successfully!');
        })
        .catch(() => {
            if (showToast) toastr.error('Save failed. Please try again.');
        });
    }

    document.getElementById('btnSave').addEventListener('click', () => savePage(true));

    // Auto-save every 90 seconds
    setInterval(() => savePage(false), 90000);

    // ── Default page if empty ──────────────────────────────────────────────
    function getDefaultPage() {
        return `<section style="padding:100px 20px;text-align:center;background:linear-gradient(135deg,#1a1a2e,#0f3460);color:#fff;">
  <h1 style="font-size:3rem;font-weight:800;margin-bottom:20px;">Your Webinar Title</h1>
  <p style="font-size:18px;color:#94a3b8;max-width:500px;margin:0 auto 32px;">Start building your webinar page by dragging blocks from the left panel.</p>
  <a href="#register" style="background:#6366f1;color:#fff;padding:16px 40px;border-radius:8px;font-weight:700;text-decoration:none;font-size:16px;">Register Now →</a>
</section>`;
    }

    // ── Panel tweaks ──────────────────────────────────────────────────────
    editor.on('load', () => {
        // Show blocks panel by default
        editor.runCommand('open-blocks');
    });

})();
</script>
</body>
</html>
