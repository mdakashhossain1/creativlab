<div id="page-shimmer" aria-hidden="true">

    {{-- ── TOP BAR (email / phone / currency / lang) ── --}}
    <div class="sk-topbar">
        <div class="sk-topbar-left">
            <div class="sk-bone" style="width:16px;height:16px;border-radius:50%"></div>
            <div class="sk-bone" style="width:160px;height:13px;border-radius:3px"></div>
            <div class="sk-bone" style="width:16px;height:16px;border-radius:50%"></div>
            <div class="sk-bone" style="width:120px;height:13px;border-radius:3px"></div>
        </div>
        <div class="sk-topbar-right">
            <div class="sk-bone" style="width:60px;height:13px;border-radius:3px"></div>
            <div class="sk-bone" style="width:60px;height:13px;border-radius:3px"></div>
            <div class="sk-bone" style="width:70px;height:28px;border-radius:4px"></div>
        </div>
    </div>

    {{-- ── MAIN NAV (logo · menu links · search · wishlist · cart · btn) ── --}}
    <div class="sk-nav">
        {{-- logo --}}
        <div class="sk-bone" style="width:140px;height:40px;border-radius:6px"></div>

        {{-- nav links --}}
        <div class="sk-nav-links">
            @for($i=0;$i<5;$i++)
            <div class="sk-bone" style="width:{{ [58,70,52,64,56][$i] }}px;height:15px;border-radius:3px"></div>
            @endfor
        </div>

        {{-- right icons --}}
        <div class="sk-nav-actions">
            <div class="sk-bone" style="width:130px;height:38px;border-radius:100px"></div>
            <div class="sk-bone" style="width:46px;height:46px;border-radius:50%"></div>
            <div class="sk-bone" style="width:46px;height:46px;border-radius:50%"></div>
            <div class="sk-bone" style="width:110px;height:46px;border-radius:24px"></div>
        </div>
    </div>

    {{-- ── HERO (left: badge + heading + body + buttons · right: image) ── --}}
    <div class="sk-hero">
        <div class="sk-hero-text">
            <div class="sk-bone" style="width:160px;height:32px;border-radius:100px;margin-bottom:20px"></div>
            <div class="sk-bone" style="width:100%;height:56px;border-radius:8px;margin-bottom:12px"></div>
            <div class="sk-bone" style="width:88%;height:56px;border-radius:8px;margin-bottom:20px"></div>
            <div class="sk-bone" style="width:75%;height:18px;border-radius:4px;margin-bottom:8px"></div>
            <div class="sk-bone" style="width:65%;height:18px;border-radius:4px;margin-bottom:32px"></div>
            <div style="display:flex;gap:14px">
                <div class="sk-bone" style="width:150px;height:50px;border-radius:100px"></div>
                <div class="sk-bone" style="width:150px;height:50px;border-radius:100px"></div>
            </div>
            {{-- trust badges / stats row --}}
            <div style="display:flex;gap:24px;margin-top:32px">
                @for($i=0;$i<3;$i++)
                <div style="display:flex;flex-direction:column;gap:6px">
                    <div class="sk-bone" style="width:50px;height:22px;border-radius:4px"></div>
                    <div class="sk-bone" style="width:70px;height:13px;border-radius:3px"></div>
                </div>
                @endfor
            </div>
        </div>
        <div class="sk-bone sk-hero-img"></div>
    </div>

    {{-- ── CLIENTS LOGO STRIP ── --}}
    <div class="sk-strip">
        <div class="sk-bone" style="width:100px;height:14px;border-radius:3px"></div>
        <div class="sk-strip-logos">
            @for($i=0;$i<6;$i++)
            <div class="sk-bone" style="width:90px;height:28px;border-radius:4px"></div>
            @endfor
        </div>
    </div>

    {{-- ── SERVICES CARDS ROW ── --}}
    <div class="sk-section">
        <div class="sk-section-head">
            <div class="sk-bone" style="width:100px;height:14px;border-radius:3px;margin-bottom:12px"></div>
            <div class="sk-bone" style="width:320px;height:36px;border-radius:6px;margin-bottom:10px"></div>
            <div class="sk-bone" style="width:260px;height:18px;border-radius:4px"></div>
        </div>
        <div class="sk-cards">
            @for($i=0;$i<3;$i++)
            <div class="sk-card">
                <div class="sk-bone" style="width:52px;height:52px;border-radius:12px;margin-bottom:18px"></div>
                <div class="sk-bone" style="width:70%;height:20px;border-radius:4px;margin-bottom:10px"></div>
                <div class="sk-bone" style="width:100%;height:13px;border-radius:3px;margin-bottom:6px"></div>
                <div class="sk-bone" style="width:90%;height:13px;border-radius:3px;margin-bottom:6px"></div>
                <div class="sk-bone" style="width:80%;height:13px;border-radius:3px;margin-bottom:20px"></div>
                <div class="sk-bone" style="width:90px;height:36px;border-radius:100px"></div>
            </div>
            @endfor
        </div>
    </div>

    {{-- ── TWO-COLUMN ABOUT / FEATURE ── --}}
    <div class="sk-section sk-section-alt">
        <div class="sk-two-col">
            <div class="sk-bone" style="width:100%;height:380px;border-radius:16px"></div>
            <div style="display:flex;flex-direction:column;gap:14px;justify-content:center">
                <div class="sk-bone" style="width:100px;height:14px;border-radius:3px"></div>
                <div class="sk-bone" style="width:100%;height:42px;border-radius:6px"></div>
                <div class="sk-bone" style="width:85%;height:42px;border-radius:6px"></div>
                <div class="sk-bone" style="width:100%;height:16px;border-radius:4px;margin-top:6px"></div>
                <div class="sk-bone" style="width:90%;height:16px;border-radius:4px"></div>
                <div class="sk-bone" style="width:80%;height:16px;border-radius:4px"></div>
                @for($i=0;$i<3;$i++)
                <div style="display:flex;align-items:center;gap:10px;margin-top:4px">
                    <div class="sk-bone" style="width:22px;height:22px;border-radius:50%"></div>
                    <div class="sk-bone" style="width:200px;height:14px;border-radius:3px"></div>
                </div>
                @endfor
                <div class="sk-bone" style="width:140px;height:50px;border-radius:100px;margin-top:10px"></div>
            </div>
        </div>
    </div>

</div>

<style>
/* ── Reset ── */
#page-shimmer *{box-sizing:border-box;margin:0;padding:0}

/* ── Overlay ── */
#page-shimmer{
    position:fixed;inset:0;z-index:99999;
    background:#fff;overflow:hidden;
    opacity:1;transition:opacity .35s ease;
}
#page-shimmer.sk-out{opacity:0;pointer-events:none}

/* ── Shimmer wave (boneyard "shimmer" mode equivalent) ── */
.sk-bone{
    flex-shrink:0;
    background:linear-gradient(90deg,#ebebeb 25%,#d6d6d6 50%,#ebebeb 75%);
    background-size:400% 100%;
    animation:sk-wave 1.5s ease-in-out infinite;
}
@keyframes sk-wave{
    0%  {background-position:100% 50%}
    100%{background-position:0%   50%}
}

/* ── Top bar ── */
.sk-topbar{
    display:flex;justify-content:space-between;align-items:center;
    height:45px;padding:0 60px;
    background:#f8f8ff;border-bottom:1px solid #eee;
}
.sk-topbar-left,.sk-topbar-right{display:flex;align-items:center;gap:14px}

/* ── Nav ── */
.sk-nav{
    display:flex;justify-content:space-between;align-items:center;
    height:95px;padding:0 60px;
    border-bottom:1px solid #eee;background:#fff;
}
.sk-nav-links{display:flex;align-items:center;gap:32px}
.sk-nav-actions{display:flex;align-items:center;gap:12px}

/* ── Hero ── */
.sk-hero{
    display:flex;justify-content:space-between;align-items:center;
    padding:70px 60px 60px;gap:40px;
}
.sk-hero-text{flex:1;display:flex;flex-direction:column}
.sk-hero-img{width:500px;height:420px;border-radius:20px;flex-shrink:0}

/* ── Client strip ── */
.sk-strip{
    padding:20px 60px 28px;
    display:flex;flex-direction:column;gap:16px;
    border-top:1px solid #f0f0f0;
}
.sk-strip-logos{display:flex;align-items:center;gap:40px}

/* ── Sections ── */
.sk-section{padding:70px 60px}
.sk-section-alt{background:#f9f8ff}
.sk-section-head{text-align:center;display:flex;flex-direction:column;align-items:center;margin-bottom:48px}
.sk-cards{display:grid;grid-template-columns:repeat(3,1fr);gap:24px}
.sk-card{
    background:#fff;border:1px solid #f0f0f0;
    border-radius:16px;padding:32px 28px;
    display:flex;flex-direction:column;
}
.sk-two-col{display:grid;grid-template-columns:1fr 1fr;gap:70px;align-items:center}

/* ── Mobile ── */
@media(max-width:900px){
    .sk-topbar,.sk-nav,.sk-hero,.sk-strip,
    .sk-section,.sk-section-alt{padding-left:20px;padding-right:20px}
    .sk-topbar-left .sk-bone:nth-child(3),
    .sk-topbar-left .sk-bone:nth-child(4){display:none}
    .sk-topbar-right{display:none}
    .sk-nav-links,.sk-nav-actions{display:none}
    .sk-hero{flex-direction:column}
    .sk-hero-img{width:100%;height:220px}
    .sk-cards{grid-template-columns:1fr}
    .sk-two-col{grid-template-columns:1fr}
    .sk-strip-logos .sk-bone:nth-child(n+4){display:none}
}
</style>

<script>
(function(){
    function hide(){
        var el=document.getElementById('page-shimmer');
        if(!el)return;
        el.classList.add('sk-out');
        setTimeout(function(){el.remove()},380);
    }
    if(document.readyState==='complete'){hide();}
    else{
        window.addEventListener('load',hide);
        setTimeout(hide,5000); // hard fallback
    }
})();
</script>
