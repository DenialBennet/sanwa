import {test,expect} from '@playwright/test';
test('Public page renders assets, interactions, and safe database fallback', async ({page})=>{
  const errors:string[]=[];
  page.on('pageerror',e=>errors.push(e.message));
  await page.goto('/');
  await expect(page.getByRole('heading',{level:1})).toContainText('National Freight');
  await expect(page.locator('#beranda .reveal-immediate').first()).toHaveClass(/active/);
  for(const img of await page.locator('img').all()) {
    await img.scrollIntoViewIfNeeded();
    await expect(img).toHaveJSProperty('complete',true);
    expect(await img.evaluate((el:HTMLImageElement)=>el.naturalWidth)).toBeGreaterThan(0);
  }
  await expect(page.locator('#jadwal')).toContainText('Jadwal sementara tidak tersedia');
  const faq=page.getByRole('button',{name:/Apa saja rute spesialisasi/});
  await faq.scrollIntoViewIfNeeded();
  await faq.click();
  await expect(page.getByText('Kami berfokus pada layanan pengiriman dan konektivitas logistik menuju wilayah Indonesia Timur,',{exact:false})).toBeVisible();
  for(const el of await page.locator('.reveal-on-scroll').all()) await el.scrollIntoViewIfNeeded();
  await page.evaluate(()=>window.scrollTo(0,0));
  await page.waitForTimeout(1400);
  await page.screenshot({path:'exports/desktop.png',fullPage:true});
  expect(errors).toEqual([]);
});
test('Mobile navigation and admin configuration work', async ({page})=>{
  const errors:string[]=[];
  page.on('pageerror',e=>errors.push(e.message));
  await page.setViewportSize({width:390,height:844});
  await page.goto('/');
  const menu=page.getByRole('button',{name:'Buka menu navigasi'});
  await menu.click();
  await expect(menu).toHaveAttribute('aria-expanded','true');
  await page.locator('header').getByRole('link',{name:'Jadwal Kapal',exact:true}).filter({visible:true}).click();
  await expect(menu).toHaveAttribute('aria-expanded','false');
  expect(await page.evaluate(()=>document.documentElement.scrollWidth<=window.innerWidth)).toBe(true);
  for(const el of await page.locator('.reveal-on-scroll').all()) await el.scrollIntoViewIfNeeded();
  await page.evaluate(()=>window.scrollTo(0,0));
  await page.waitForTimeout(1400);
  await page.screenshot({path:'exports/mobile.png',fullPage:true});
  await page.goto('/sanwa-internal-portal/login');
  await page.getByLabel('Email').fill('admin@example.com');
  await page.getByLabel('Password',{exact:true}).fill('example-password');
  await page.getByRole('button',{name:'Masuk',exact:true}).click();
  await expect(page.locator('p[role="alert"]')).toContainText('Supabase belum dikonfigurasi');
  await page.goto('/unknown-admin/schedules');
  await expect(page.getByRole('heading')).toContainText('Halaman tidak ditemukan');
  expect(errors).toEqual([]);
});
