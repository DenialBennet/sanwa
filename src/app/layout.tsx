import type { Metadata } from 'next';
import './globals.css';
export const metadata: Metadata = {
  title: 'PT Sanwa Antar Nusa — Ekspedisi & Logistik Nasional',
  description: 'Jasa ekspedisi dan logistik nasional: kargo laut dan pengiriman darat ke seluruh Indonesia.',
  verification: {google:'googleb1b74ce866d282db'},
  icons: {icon:'/favicon.ico',apple:'/apple-touch-icon.png'}
};
export default function Layout({children}: {children:React.ReactNode}) {
  return <html lang="id" className="scroll-smooth"><head><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" /></head><body>{children}</body></html>;
}
