'use client';
export default function ErrorPage({reset}:{reset:()=>void}) {return <main className="max-w-xl mx-auto p-10"><h1 className="text-2xl font-bold">Halaman belum bisa dimuat</h1><p className="my-5">Silakan coba lagi atau hubungi pengelola website.</p><button className="btn-accent" onClick={reset}>Coba Lagi</button></main>;}
