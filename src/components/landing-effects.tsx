'use client';
import { useEffect } from 'react';
let started = false;
export default function LandingEffects() {
  useEffect(() => {
    let cancelled = false;
    let observer: IntersectionObserver | undefined;
    void (async () => {
      const [{default: Alpine}, {createIcons, icons}] = await Promise.all([import('alpinejs'),import('lucide')]);
      if (cancelled) return;
      if (!started) { Alpine.start(); started = true; }
      createIcons({icons});
      observer = new IntersectionObserver(entries => entries.forEach(entry => {
        if (entry.isIntersecting) entry.target.classList.add('active');
      }),{threshold:0.05});
      document.querySelectorAll('.reveal-on-scroll, .reveal-immediate').forEach(el=>observer!.observe(el));
      document.querySelectorAll<HTMLElement>('.count-up').forEach(el=>{
        const target=Number(el.dataset.target);
        el.textContent=(el.dataset.format==='k' ? `${Math.round(target/1000)}K` : target.toLocaleString('id-ID'))+(el.dataset.suffix || '');
      });
    })();
    return () => {cancelled=true; observer?.disconnect();};
  },[]);
  return null;
}
