import { useEffect, useMemo, useRef, useState } from "react";

// ------------------------------
// Editable site data (all copy lives here)
// ------------------------------
const SITE = {
  brand: {
    name: "Institut Sains & Teknologi Nasional",
    short: "ISTN-Inspired",
    // TODO: Replace with your legal logo asset
    logoAlt: "Logo kampus",
  },
  nav: [
    { label: "Beranda", href: "#beranda" },
    { label: "Program Studi", href: "#program" },
    { label: "Beasiswa", href: "#beasiswa" },
    { label: "Karir", href: "#karir" },
    { label: "Daftar", href: "#daftar" },
    { label: "Tentang Kami", href: "#tentang" },
    { label: "Alumni", href: "#alumni" },
    { label: "Berita", href: "#berita" },
    { label: "Kolaborasi Strategis", href: "#kolaborasi" },
    { label: "TDC", href: "#tdc" },
    { label: "Kemahasiswaan", href: "#kemahasiswaan" },
    { label: "Laporan Tahunan", href: "#laporan" },
    { label: "Aplikasi Internal", href: "#aplikasi" },
    { label: "Kalender Akademik", href: "#kalender" },
  ],
  hero: {
    title: "Institut Sains & Teknologi – untuk Generasi Pelopor",
    subtitle:
      "Program studi berorientasi masa depan. Kurikulum adaptif. Kolaborasi industri nyata.",
    ctas: [
      { label: "Daftar Sekarang", href: "#daftar" },
      { label: "Jelajahi Program", href: "#program" },
    ],
    // TODO Replace with legal background asset
    bgAlt: "Gedung kampus dengan nuansa modern",
  },
  programs: {
    tabs: [
      {
        key: "S1",
        label: "Sarjana (S1)",
        faculty: "Fakultas Sains Terapan dan Teknologi",
        items: [
          "Sarjana Arsitektur",
          "Sarjana Arsitektur Lanskap",
          "Sarjana Fisika",
          "Sarjana Matematika",
          "Sarjana Sistem Informasi",
          "Sarjana Teknik Elektro",
          "Sarjana Teknik Industri",
          "Sarjana Teknik Informatika",
          "Sarjana Teknik Mesin",
          "Sarjana Teknik Sipil",
        ],
      },
      {
        key: "S2",
        label: "Magister (S2)",
        faculty: "Fakultas Sains Terapan dan Teknologi",
        items: [
          "Magister Teknik Elektro",
          "Magister Teknik Industri",
          "Magister Teknik Mesin",
          "Magister Teknik Sipil",
        ],
      },
      {
        key: "Profesi",
        label: "Profesi",
        faculty: "Fakultas Farmasi",
        items: ["Program Studi Profesi Apoteker (PSPA)"],
      },
      { key: "RPL", label: "RPL", faculty: "Rekognisi Pembelajaran Lampau", items: [] },
    ],
  },
  news: [
    {
      date: "28 Agt",
      title: "Alur Penyelesaian Studi Mahasiswa ISTN",
      excerpt: "Panduan ringkas tahapan penyelesaian studi mahasiswa.",
      href: "#",
      image: "https://picsum.photos/seed/news1/800/450.jpg",
    },
    {
      date: "25 Agt",
      title:
        "Rektor ISTN Lakukan Kunjungan ke ITB, bahas peluang kerja sama Tri Dharma",
      excerpt: "Kolaborasi akademik dan riset antara kampus.",
      href: "#",
      image: "https://picsum.photos/seed/news2/800/450.jpg",
    },
    {
      date: "—",
      title: "ISTN Buka Peluang Magang di Jepang",
      excerpt: "Kerja sama dengan Nakatani Enetec Corporation.",
      href: "#",
      image: "https://picsum.photos/seed/news3/800/450.jpg",
    },
    {
      date: "—",
      title: "ISTN Dorong Kedaulatan Digital Kesehatan",
      excerpt: "Sorotan dari forum ISIF 2025 di Jakarta.",
      href: "#",
      image: "https://picsum.photos/seed/news4/800/450.jpg",
    },
  ],
  highlights: [
    {
      title: "ISTN Kampus Kolaborasi: ISTN x Industri",
      caption: "Kolaborasi dengan berbagai mitra untuk menyiapkan lulusan siap kerja.",
      image: "https://picsum.photos/seed/highlight1/800/450.jpg",
    },
    { 
      title: "Magister Digital Transformation & Cybersecurity", 
      caption: "Dua spesialisasi unggulan.",
      image: "https://picsum.photos/seed/highlight2/800/450.jpg",
    },
  ],
  partners: [
    "Xynexis International",
    "IDPRO",
    "KORIKA",
    "MASTEL",
    "Mitra Industri A",
    "Mitra Industri B",
  ],
  alumni: {
    featured: {
      name: "Dr. Ir. Afrianyah Noor, M. Si.",
      headline: "Teknik Sipil '90 / Wakil Menteri Ketenagakerjaan RI",
      quote:
        "Belajar adalah tugas mulia, dan karya terbaik selalu kembali untuk bangsa.",
      href: "#",
      image: "https://picsum.photos/seed/alumni1/400/400.jpg",
    },
  },
  about: {
    summary:
      "Institut Sains dan Teknologi Nasional (ISTN) adalah bagian dari Yayasan Perguruan 'Cikini' yang berlokasi di Jakarta. Berdiri sejak tahun 1950 dan menjadi salah satu perguruan tinggi teknik swasta tertua di Indonesia.",
    address:
      "Jl. Moch. Kahfi II No.30, Srengseng Sawah, Jagakarsa, Jakarta Selatan 12630",
    vision:
      "Menjadi center of excellence dalam pendidikan tinggi sains dan teknologi yang kreatif, inovatif, unggul, dan berjiwa pelopor.",
    mission: [
      "Menyelenggarakan Tridharma berkualitas di bidang sains dan teknologi.",
      "Mengembangkan kurikulum unggulan yang adaptif.",
      "Meningkatkan sarana prasarana untuk Tridharma dan pusat pengembangan.",
      "Menumbuhkan kerja sama, kolaborasi, dan jejaring industri.",
      "Mewujudkan Good University Governance berkelanjutan.",
    ],
  },
  social: [
    { label: "Facebook", href: "#", icon: "M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" },
    { label: "LinkedIn", href: "#", icon: "M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" },
    { label: "YouTube", href: "#", icon: "M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" },
    { label: "Instagram", href: "#", icon: "M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zM5.838 12a6.162 6.162 0 1 1 12.324 0 6.162 6.162 0 0 1-12.324 0zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm4.965-10.405a1.44 1.44 0 1 1 2.881.001 1.44 1.44 0 0 1-2.881-.001z" },
  ],
  calendar: {
    title: "Kalender Akademik",
    description: "Tetap update dengan jadwal penting kampus",
    cta: "Lihat Kalender Lengkap",
    href: "#kalender",
  },
  podcast: {
    title: "ISTN Podcast & Radio",
    description: "Dengarkan wawasan dari para ahli dan tokoh industri",
    cta: "Tune In",
    href: "#podcast",
  }
};

// ------------------------------
// Utility & Base components
// ------------------------------
const Container = ({ children, className = "" }) => (
  <div className={`mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8 ${className}`}>{children}</div>
);

const SectionHeading = ({ eyebrow, title, subtitle, center }) => (
  <div className={`mb-10 ${center ? "text-center" : "text-left"}`}>
    {eyebrow && (
      <p className="mb-2 text-sm font-semibold uppercase tracking-widest text-indigo-600">{eyebrow}</p>
    )}
    <h2 className="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900">{title}</h2>
    {subtitle && <p className="mt-3 text-gray-600 max-w-2xl mx-auto">{subtitle}</p>}
  </div>
);

const Badge = ({ children }) => (
  <span className="inline-flex items-center rounded-full border border-indigo-200 bg-indigo-50 px-3 py-1 text-xs font-medium text-indigo-700">
    {children}
  </span>
);

const Card = ({ as: Tag = "div", className = "", children, hover = false }) => (
  <Tag className={`rounded-2xl border border-gray-200 bg-white p-6 shadow-sm ${hover ? "transition-all duration-300 hover:shadow-lg hover:-translate-y-1" : ""} ${className}`}>{children}</Tag>
);

// A simple, dependency-free carousel with minimal JS
function Carousel({ items, renderItem, interval = 6000, ariaLabel = "Carousel" }) {
  const [index, setIndex] = useState(0);
  const [isPaused, setIsPaused] = useState(false);
  const timeoutRef = useRef(null);

  const nextSlide = () => {
    setIndex((i) => (i + 1) % items.length);
  };

  const prevSlide = () => {
    setIndex((i) => (i - 1 + items.length) % items.length);
  };

  const goToSlide = (i) => {
    setIndex(i);
  };

  useEffect(() => {
    if (items.length <= 1 || isPaused) return;
    timeoutRef.current = setTimeout(nextSlide, interval);
    return () => clearTimeout(timeoutRef.current);
  }, [index, items.length, interval, isPaused]);

  return (
    <div 
      className="relative" 
      aria-roledescription="carousel" 
      aria-label={ariaLabel}
      onMouseEnter={() => setIsPaused(true)}
      onMouseLeave={() => setIsPaused(false)}
    >
      <div className="overflow-hidden rounded-2xl">
        <div
          className="flex transition-transform duration-700 ease-in-out"
          style={{ transform: `translateX(-${index * 100}%)` }}
        >
          {items.map((it, i) => (
            <div key={i} className="min-w-full">
              {renderItem(it, i)}
            </div>
          ))}
        </div>
      </div>
      
      {items.length > 1 && (
        <>
          <button
            className="absolute left-4 top-1/2 -translate-y-1/2 rounded-full bg-white/80 p-2 shadow-md transition-all hover:bg-white"
            onClick={prevSlide}
            aria-label="Previous slide"
          >
            <svg className="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15 19l-7-7 7-7" />
            </svg>
          </button>
          <button
            className="absolute right-4 top-1/2 -translate-y-1/2 rounded-full bg-white/80 p-2 shadow-md transition-all hover:bg-white"
            onClick={nextSlide}
            aria-label="Next slide"
          >
            <svg className="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M9 5l7 7-7 7" />
            </svg>
          </button>
          <div className="mt-3 flex justify-center gap-2" role="tablist">
            {items.map((_, i) => (
              <button
                key={i}
                role="tab"
                aria-selected={i === index}
                aria-label={`Slide ${i + 1}`}
                className={`h-2 w-2 rounded-full transition-all ${i === index ? "bg-indigo-600 w-8" : "bg-gray-300"}`}
                onClick={() => goToSlide(i)}
              />
            ))}
          </div>
        </>
      )}
    </div>
  );
}

function TabGroup({ tabs, renderList }) {
  const [active, setActive] = useState(tabs[0]?.key);
  const activeTab = useMemo(() => tabs.find((t) => t.key === active), [tabs, active]);

  return (
    <div>
      <div role="tablist" className="flex flex-wrap gap-2">
        {tabs.map((t) => (
          <button
            key={t.key}
            role="tab"
            aria-selected={t.key === active}
            className={`rounded-full px-4 py-2 text-sm font-semibold transition-all ${
              t.key === active
                ? "bg-indigo-600 text-white shadow-md"
                : "bg-white text-gray-700 border border-gray-300 hover:border-gray-400 hover:bg-gray-50"
            }`}
            onClick={() => setActive(t.key)}
          >
            {t.label}
          </button>
        ))}
      </div>

      <div className="mt-6">
        {activeTab ? renderList(activeTab) : <p>—</p>}
      </div>
    </div>
  );
}

const LogoCloud = ({ names }) => (
  <div className="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
    {names.map((n, i) => (
      <div
        key={i}
        className="flex h-16 items-center justify-center rounded-xl border border-gray-200 bg-white px-4 transition-all hover:shadow-md hover:-translate-y-1"
        aria-label={`Logo ${n}`}
      >
        {/* TODO: Replace text with your legal logo images */}
        <span className="text-sm font-semibold text-gray-700">{n}</span>
      </div>
    ))}
  </div>
);

// ------------------------------
// Top elements: Skip link + Header + Nav
// ------------------------------
const SkipToContent = () => (
  <a
    href="#main"
    className="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50 focus:rounded-md focus:bg-white focus:px-4 focus:py-2 focus:shadow-lg focus:text-indigo-600"
  >
    Skip to Main Content
  </a>
);

const TopBar = () => (
  <div className="bg-gray-900 text-gray-100">
    <Container className="flex flex-wrap items-center justify-between py-2 text-xs">
      <div className="flex flex-wrap items-center gap-3">
        <a href="#tentang" className="opacity-80 hover:opacity-100 transition-opacity">Tentang Kami</a>
        <a href="#kolaborasi" className="opacity-80 hover:opacity-100 transition-opacity">Kolaborasi</a>
        <a href="#kemahasiswaan" className="opacity-80 hover:opacity-100 transition-opacity">Kemahasiswaan</a>
        <a href="#laporan" className="opacity-80 hover:opacity-100 transition-opacity">Laporan Tahunan</a>
        <a href="#kalender" className="opacity-80 hover:opacity-100 transition-opacity">Kalender Akademik</a>
        <a href="#aplikasi" className="opacity-80 hover:opacity-100 transition-opacity">Aplikasi Internal</a>
      </div>
      <div>
        <Badge>🇮🇩 Bahasa Indonesia</Badge>
      </div>
    </Container>
  </div>
);

function Navbar() {
  const [open, setOpen] = useState(false);
  const [scrolled, setScrolled] = useState(false);
  
  useEffect(() => {
    const onKey = (e) => e.key === "Escape" && setOpen(false);
    window.addEventListener("keydown", onKey);
    
    const onScroll = () => {
      setScrolled(window.scrollY > 10);
    };
    
    window.addEventListener("scroll", onScroll);
    
    return () => {
      window.removeEventListener("keydown", onKey);
      window.removeEventListener("scroll", onScroll);
    };
  }, []);

  return (
    <header className={`sticky top-0 z-40 transition-all duration-300 ${scrolled ? "bg-white/95 backdrop-blur-md shadow-sm" : "bg-white/80 backdrop-blur supports-[backdrop-filter]:bg-white/60"} border-b border-gray-100`}>
      <Container className="flex items-center justify-between py-4">
        <div className="flex items-center gap-3">
          <div className="h-9 w-9 rounded-xl bg-gradient-to-br from-indigo-600 to-violet-600" aria-hidden />
          <div className="leading-tight">
            <p className="text-sm font-semibold text-gray-900">{SITE.brand.short}</p>
            <p className="text-xs text-gray-500">{SITE.brand.name}</p>
          </div>
        </div>

        <nav className="hidden lg:flex items-center gap-6" aria-label="Primary">
          {SITE.nav.map((n) => (
            <a key={n.href} href={n.href} className="text-sm font-medium text-gray-700 hover:text-indigo-600 transition-colors">
              {n.label}
            </a>
          ))}
          <a
            href="#daftar"
            className="rounded-full bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700 transition-colors shadow-sm"
          >
            Daftar
          </a>
        </nav>

        <button
          className="lg:hidden rounded-lg border border-gray-300 p-2 hover:bg-gray-50 transition-colors"
          aria-label="Toggle menu"
          onClick={() => setOpen((v) => !v)}
        >
          <svg className="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            {open ? (
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M6 18L18 6M6 6l12 12" />
            ) : (
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M4 6h16M4 12h16M4 18h16" />
            )}
          </svg>
        </button>
      </Container>

      {open && (
        <div className="lg:hidden border-t border-gray-100 bg-white">
          <Container className="py-4 grid gap-2">
            {SITE.nav.map((n) => (
              <a key={n.href} href={n.href} className="text-sm font-medium text-gray-700 py-2 hover:text-indigo-600 transition-colors">
                {n.label}
              </a>
            ))}
            <a href="#daftar" className="mt-2 rounded-lg bg-indigo-600 px-4 py-2 text-center text-sm font-semibold text-white">
              Daftar
            </a>
          </Container>
        </div>
      )}
    </header>
  );
}

// ------------------------------
// Sections
// ------------------------------
const Hero = () => (
  <section id="beranda" className="relative overflow-hidden">
    <div className="absolute inset-0 -z-10 bg-gradient-to-b from-indigo-50 to-white" aria-hidden />
    {/* Decorative gradient blob */}
    <div className="pointer-events-none absolute -top-24 -left-24 h-96 w-96 rounded-full bg-indigo-200/40 blur-3xl" aria-hidden />
    <Container className="py-16 lg:py-24">
      <div className="grid items-center gap-10 lg:grid-cols-2">
        <div>
          <Badge>Institut Sains & Teknologi</Badge>
          <h1 className="mt-4 text-3xl font-black leading-tight text-gray-900 sm:text-5xl">
            {SITE.hero.title}
          </h1>
          <p className="mt-4 text-lg text-gray-600">{SITE.hero.subtitle}</p>
          <div className="mt-6 flex flex-wrap gap-3">
            {SITE.hero.ctas.map((c) => (
              <a
                key={c.href}
                href={c.href}
                className="rounded-full bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow hover:bg-indigo-700 transition-colors"
              >
                {c.label}
              </a>
            ))}
            <a href="#program" className="rounded-full border border-gray-300 px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-colors">
              Lihat Program
            </a>
          </div>
        </div>
        {/* Hero image placeholder */}
        <div className="relative aspect-[4/3] w-full overflow-hidden rounded-3xl border border-gray-200 bg-white shadow-lg">
          {/* TODO: Replace with legal image asset */}
          <img 
            src="https://picsum.photos/seed/campus/800/600.jpg" 
            alt={SITE.hero.bgAlt}
            className="w-full h-full object-cover"
            loading="lazy"
          />
        </div>
      </div>
    </Container>
  </section>
);

const Programs = () => (
  <section id="program" className="py-16 lg:py-24">
    <Container>
      <SectionHeading
        eyebrow="Program Studi"
        title="Pilihan Program Studi"
        subtitle="Siap level up? Kembangkan bakatmu jadi keahlian profesional."
        center
      />

      <Card>
        <TabGroup
          tabs={SITE.programs.tabs}
          renderList={(tab) => (
            <div>
              <p className="text-sm text-gray-500">{tab.faculty}</p>
              <ul className="mt-4 grid gap-3 sm:grid-cols-2 md:grid-cols-3">
                {tab.items.length ? (
                  tab.items.map((name, i) => (
                    <li key={i} className="flex items-start gap-2 group">
                      <span className="mt-1 text-indigo-600 group-hover:translate-x-1 transition-transform">•</span>
                      <span className="text-gray-800 group-hover:text-indigo-600 transition-colors">{name}</span>
                    </li>
                  ))
                ) : (
                  <li className="text-gray-500">Informasi RPL akan diperbarui.</li>
                )}
              </ul>
              <div className="mt-6">
                <a href="#daftar" className="rounded-full bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700 transition-colors shadow-sm">
                  Daftar
                </a>
              </div>
            </div>
          )}
        />
      </Card>
    </Container>
  </section>
);

const News = () => (
  <section id="berita" className="bg-gray-50 py-16 lg:py-24">
    <Container>
      <SectionHeading eyebrow="Berita Terbaru" title="Sorotan & Kegiatan" center />
      <div className="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        {SITE.news.map((n, i) => (
          <Card key={i} className="flex flex-col hover">
            <div className="aspect-[16/9] w-full overflow-hidden rounded-xl">
              <img 
                src={n.image} 
                alt={n.title}
                className="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                loading="lazy"
              />
            </div>
            <div className="mt-4">
              <p className="text-xs uppercase tracking-wide text-indigo-600">{n.date}</p>
              <h3 className="mt-1 text-lg font-semibold text-gray-900">{n.title}</h3>
              <p className="mt-2 text-sm text-gray-600">{n.excerpt}</p>
            </div>
            <div className="mt-4">
              <a href={n.href} className="text-sm font-semibold text-indigo-600 hover:text-indigo-700 transition-colors">
                Selengkapnya →
              </a>
            </div>
          </Card>
        ))}
      </div>
      <div className="mt-8 text-center">
        <a href="#" className="text-sm font-semibold text-gray-700 hover:text-gray-900 transition-colors">
          Lihat Semua Berita →
        </a>
      </div>
    </Container>
  </section>
);

const Collaboration = () => (
  <section id="kolaborasi" className="py-16 lg:py-24">
    <Container>
      <SectionHeading
        eyebrow="Kolaborasi"
        title="ISTN Kampus Kolaborasi: ISTN x Industri"
        subtitle="Jejaring kemitraan strategis untuk pengalaman belajar dan karier yang relevan."
        center
      />
      <LogoCloud names={SITE.partners} />
    </Container>
  </section>
);

const Alumni = () => (
  <section id="alumni" className="bg-gray-50 py-16 lg:py-24">
    <Container>
      <SectionHeading eyebrow="Alumni" title="Alumni ISTN Highlights" center />
      <Card className="grid gap-6 md:grid-cols-3 hover">
        <div className="md:col-span-2">
          <h3 className="text-xl font-bold text-gray-900">{SITE.alumni.featured.name}</h3>
          <p className="text-sm text-gray-600">{SITE.alumni.featured.headline}</p>
          <p className="mt-4 text-gray-700 italic">"{SITE.alumni.featured.quote}"</p>
          <div className="mt-6">
            <a href={SITE.alumni.featured.href} className="text-sm font-semibold text-indigo-600 hover:text-indigo-700 transition-colors">
              Profile Alumni Lainnya →
            </a>
          </div>
        </div>
        <div className="relative aspect-[4/3] w-full overflow-hidden rounded-2xl">
          <img 
            src={SITE.alumni.featured.image} 
            alt={SITE.alumni.featured.name}
            className="w-full h-full object-cover"
            loading="lazy"
          />
        </div>
      </Card>
    </Container>
  </section>
);

const Podcast = () => (
  <section id="podcast" className="py-16 lg:py-24">
    <Container>
      <div className="grid gap-8 md:grid-cols-2 items-center">
        <div>
          <SectionHeading
            eyebrow="Podcast"
            title={SITE.podcast.title}
            subtitle={SITE.podcast.description}
          />
          <a 
            href={SITE.podcast.href} 
            className="inline-flex items-center gap-2 rounded-full bg-indigo-600 px-5 py-3 text-sm font-semibold text-white hover:bg-indigo-700 transition-colors shadow-sm"
          >
            <svg className="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
              <path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.37 4.37 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z" />
            </svg>
            {SITE.podcast.cta}
          </a>
        </div>
        <div className="relative aspect-[16/9] w-full overflow-hidden rounded-2xl bg-gradient-to-br from-indigo-100 to-purple-100">
          <div className="absolute inset-0 flex items-center justify-center">
            <div className="text-center">
              <div className="mx-auto h-16 w-16 rounded-full bg-indigo-600 flex items-center justify-center text-white">
                <svg className="h-8 w-8" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M18 3a1 1 0 00-1.196-.98l-10 2A1 1 0 006 5v9.114A4.369 4.369 0 005 14c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V7.82l8-1.6v5.894A4.37 4.37 0 0015 12c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2V3z" />
                </svg>
              </div>
              <p className="mt-4 text-sm font-medium text-gray-700">Podcast & Radio ISTN</p>
            </div>
          </div>
        </div>
      </div>
    </Container>
  </section>
);

const Calendar = () => (
  <section id="kalender" className="bg-gray-50 py-16 lg:py-24">
    <Container>
      <div className="grid gap-8 md:grid-cols-2 items-center">
        <div className="relative aspect-[16/9] w-full overflow-hidden rounded-2xl bg-gradient-to-br from-indigo-100 to-purple-100">
          <div className="absolute inset-0 flex items-center justify-center">
            <div className="text-center">
              <div className="mx-auto h-16 w-16 rounded-full bg-indigo-600 flex items-center justify-center text-white">
                <svg className="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
              </div>
              <p className="mt-4 text-sm font-medium text-gray-700">Kalender Akademik ISTN</p>
            </div>
          </div>
        </div>
        <div>
          <SectionHeading
            eyebrow="Informasi"
            title={SITE.calendar.title}
            subtitle={SITE.calendar.description}
          />
          <a 
            href={SITE.calendar.href} 
            className="inline-flex items-center gap-2 rounded-full bg-indigo-600 px-5 py-3 text-sm font-semibold text-white hover:bg-indigo-700 transition-colors shadow-sm"
          >
            <svg className="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            {SITE.calendar.cta}
          </a>
        </div>
      </div>
    </Container>
  </section>
);

const About = () => (
  <section id="tentang" className="py-16 lg:py-24">
    <Container>
      <SectionHeading eyebrow="Tentang Kami" title="Sepintas Lalu" center />
      <div className="grid gap-8 md:grid-cols-2">
        <Card hover>
          <p className="text-gray-700">{SITE.about.summary}</p>
          <dl className="mt-6 grid gap-3">
            <div>
              <dt className="text-sm font-semibold text-gray-900">Alamat Kampus</dt>
              <dd className="text-gray-700">{SITE.about.address}</dd>
            </div>
          </dl>
        </Card>
        <Card hover>
          <h3 className="text-lg font-semibold text-gray-900">Visi</h3>
          <p className="mt-2 text-gray-700">{SITE.about.vision}</p>
          <h3 className="mt-6 text-lg font-semibold text-gray-900">Misi</h3>
          <ul className="mt-2 list-disc pl-5 text-gray-700">
            {SITE.about.mission.map((m, i) => (
              <li key={i} className="mt-1">{m}</li>
            ))}
          </ul>
        </Card>
      </div>
    </Container>
  </section>
);

const CTA = () => (
  <section id="daftar" className="relative overflow-hidden py-16 lg:py-24">
    <div className="absolute inset-0 -z-10 bg-gradient-to-br from-indigo-600 to-violet-600" aria-hidden />
    <div className="absolute top-0 left-0 w-full h-full opacity-20">
      <div className="absolute top-0 left-0 w-64 h-64 bg-white rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
      <div className="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full blur-3xl translate-x-1/2 translate-y-1/2"></div>
    </div>
    <Container className="text-center text-white relative z-10">
      <h2 className="text-3xl font-extrabold sm:text-4xl">Siap bergabung?</h2>
      <p className="mt-3 text-white/90">Daftar sekarang dan pilih jalur suksesmu.</p>
      <div className="mt-6 flex justify-center gap-3">
        <a href="#" className="rounded-full bg-white px-5 py-3 text-sm font-semibold text-gray-900 hover:bg-gray-100 transition-colors shadow-lg">
          Formulir Pendaftaran
        </a>
        <a href="#program" className="rounded-full border border-white/70 px-5 py-3 text-sm font-semibold text-white hover:bg-white/10 transition-colors">
          Lihat Program
        </a>
      </div>
    </Container>
  </section>
);

const Footer = () => (
  <footer className="border-t border-gray-200 bg-white">
    <Container className="py-12">
      <div className="grid gap-8 md:grid-cols-4">
        <div>
          <div className="mb-3 h-10 w-10 rounded-xl bg-gradient-to-br from-indigo-600 to-violet-600" aria-hidden />
          <p className="text-sm text-gray-600">{SITE.brand.name}</p>
          <div className="mt-4 flex gap-3">
            {SITE.social.map((s) => (
              <a key={s.label} href={s.href} className="text-gray-700 hover:text-indigo-600 transition-colors" aria-label={s.label}>
                <svg className="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                  <path d={s.icon} />
                </svg>
              </a>
            ))}
          </div>
        </div>

        <div>
          <h4 className="text-sm font-semibold text-gray-900">Site Menu</h4>
          <ul className="mt-3 space-y-2 text-sm text-gray-700">
            {SITE.nav.slice(0, 8).map((n) => (
              <li key={n.href}>
                <a href={n.href} className="hover:text-indigo-600 transition-colors">{n.label}</a>
              </li>
            ))}
          </ul>
        </div>

        <div>
          <h4 className="text-sm font-semibold text-gray-900">Informasi</h4>
          <ul className="mt-3 space-y-2 text-sm text-gray-700">
            <li>
              <a href="#kalender" className="hover:text-indigo-600 transition-colors">Kalender Akademik</a>
            </li>
            <li>
              <a href="#aplikasi" className="hover:text-indigo-600 transition-colors">Aplikasi Internal</a>
            </li>
            <li>
              <a href="#beasiswa" className="hover:text-indigo-600 transition-colors">Beasiswa</a>
            </li>
          </ul>
        </div>

        <div>
          <h4 className="text-sm font-semibold text-gray-900">Kontak</h4>
          <p className="mt-3 text-sm text-gray-700">{SITE.about.address}</p>
          <p className="mt-2 text-sm text-gray-500">© 2025 – Semua hak cipta pada pemiliknya masing‑masing.</p>
        </div>
      </div>
    </Container>
  </footer>
);

// ------------------------------
// Page assembly
// ------------------------------
export default function App() {
  return (
    <div className="text-gray-900 antialiased">
      <SkipToContent />
      <TopBar />
      <Navbar />
      <main id="main">
        <Hero />
        <Programs />
        <News />
        <Carousel
          items={SITE.highlights}
          renderItem={(item, i) => (
            <div className="relative aspect-[16/9] w-full overflow-hidden rounded-2xl">
              <img 
                src={item.image} 
                alt={item.title}
                className="w-full h-full object-cover"
                loading="lazy"
              />
              <div className="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end">
                <div className="p-8 text-white">
                  <h3 className="text-2xl font-bold">{item.title}</h3>
                  <p className="mt-2 text-white/90">{item.caption}</p>
                </div>
              </div>
            </div>
          )}
          ariaLabel="Highlights carousel"
        />
        <Collaboration />
        <Alumni />
        <Podcast />
        <Calendar />
        <About />
        <CTA />
      </main>
      <Footer />

      {/*
      LEGAL & ASSET NOTES
      - Gambar, logo, ikon di sini adalah placeholder. Ganti dengan aset milik Anda atau yang izinnya jelas.
      - Jika ingin "menggunakan beberapa gambar dan style" dari situs rujukan, pastikan Anda:
        (1) Memiliki izin tertulis / lisensi yang sesuai, atau gunakan materi berlisensi ulang (mis. Creative Commons, stok berbayar);
        (2) Tidak menyalin stylesheet/proprietary design 1:1; lebih aman "menggemakan" gaya visual (warna/spacing/komponen) tanpa replika persis.
      - Simpan aset di /assets lalu perbarui src di komponen terkait.
      */}
    </div>
  );
}