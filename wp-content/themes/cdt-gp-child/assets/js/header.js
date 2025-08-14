(function(){
    // ====== Theme Switch (light/system/dark) ======
    const btns = document.querySelectorAll('.cdt-theme-btn');
    const applyTheme = (mode) => {
      if (mode === 'system') {
        document.body.removeAttribute('data-theme');
      } else {
        document.body.setAttribute('data-theme', mode);
      }
      localStorage.setItem('cdtTheme', mode);
      btns.forEach(b => b.setAttribute('aria-pressed', String(b.dataset.theme === mode)));
    };
    const saved = localStorage.getItem('cdtTheme') || 'system';
    applyTheme(saved);
    btns.forEach(b => b.addEventListener('click', () => applyTheme(b.dataset.theme)));
  
    // ====== Shrink on scroll ======
    const header = document.getElementById('cdt-header');
    const onScroll = () => {
      if (!header) return;
      if (window.scrollY > 10) header.classList.add('is-scrolled');
      else header.classList.remove('is-scrolled');
    };
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
  
    // ====== Date/Time (it-IT, Europe/Rome) ======
    const dtEl = document.getElementById('cdt-datetime');
    function updateClock(){
      try{
        const now = new Date();
        const s = now.toLocaleString('it-IT', {
          weekday:'long', day:'2-digit', month:'long', year:'numeric',
          hour:'2-digit', minute:'2-digit'
        });
        if (dtEl) dtEl.textContent = s;
      }catch(e){}
    }
    updateClock();
    setInterval(updateClock, 60*1000);
  
    // ====== Meteo Taranto (Open-Meteo, no API key) ======
    const wEl = document.getElementById('cdt-weather');
    const WMO = {
      0:'Sereno',1:'Per lo più sereno',2:'Parzialmente nuvoloso',3:'Nuvoloso',
      45:'Nebbia',48:'Nebbia brinosa',
      51:'Pioviggine leggera',53:'Pioviggine moderata',55:'Pioviggine intensa',
      61:'Pioggia leggera',63:'Pioggia moderata',65:'Pioggia intensa',
      71:'Neve leggera',73:'Neve moderata',75:'Neve intensa',
      80:'Rovesci leggeri',81:'Rovesci moderati',82:'Rovesci forti',
      95:'Temporale',96:'Temporale con grandine',99:'Temporale con grandine forte'
    };
    async function fetchWeather(){
      try{
        // Taranto: 40.4735, 17.2420
        const url = 'https://api.open-meteo.com/v1/forecast?latitude=40.4735&longitude=17.2420&current=temperature_2m,weather_code&timezone=Europe%2FRome';
        const r = await fetch(url, {cache:'no-store'});
        const j = await r.json();
        const t = Math.round(j?.current?.temperature_2m);
        const code = j?.current?.weather_code;
        const desc = WMO[code] || 'Meteo';
        if (wEl && Number.isFinite(t)) wEl.textContent = `Taranto: ${t}° · ${desc}`;
      } catch(e){
        // silenzioso
      }
    }
    fetchWeather();
  })();
  