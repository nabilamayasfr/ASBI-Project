<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignLearn</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; }

        @keyframes heroFloat {
            0%,100% { transform: translateY(0); }
            50% { transform: translateY(-12px); }
        }

        @keyframes iconBob {
            0%,100% { transform: translateY(0) rotate(0); }
            50% { transform: translateY(-8px) rotate(5deg); }
        }

        @keyframes fadeUp {
            from { opacity:0; transform:translateY(24px); }
            to { opacity:1; transform:translateY(0); }
        }
    </style>
</head>

<body class="bg-[#FEE6F2] text-[#5B2B63] overflow-x-hidden">
<div class="relative">

<!-- NAVBAR -->
<header class="flex items-center justify-between px-[48px] py-[18px] sticky top-0 z-[200] bg-[#FEE6F2]">

    <div class="flex items-center">
        <img src="{{ asset('assets/logo.png') }}" class="w-[130px]">
    </div>

    <nav class="hidden md:flex gap-[36px] text-[14.5px] text-[#492F48] font-medium">
        <a href="#" class="relative pb-[3px] hover:text-[#C82D85] group">
            Beranda
            <span class="absolute left-0 bottom-0 w-0 h-[2px] bg-[#C82D85] rounded transition-all duration-200 group-hover:w-full"></span>
        </a>
        <a href="#" class="relative pb-[3px] hover:text-[#C82D85] group">
            Pembelajaran
            <span class="absolute left-0 bottom-0 w-0 h-[2px] bg-[#C82D85] rounded transition-all duration-200 group-hover:w-full"></span>
        </a>
        <a href="#" class="relative pb-[3px] hover:text-[#C82D85] group">
            History
            <span class="absolute left-0 bottom-0 w-0 h-[2px] bg-[#C82D85] rounded transition-all duration-200 group-hover:w-full"></span>
        </a>
    </nav>

    <div class="flex gap-[12px] items-center">
        <a href="#" class="px-[26px] py-[11px] text-[14px] font-semibold rounded-[12px] border-2 border-[#742958] text-[#742958] shadow-[0_3px_10px_rgba(116,41,88,0.10)] hover:bg-[#F7DAED] hover:border-[#C82D85] hover:text-[#C82D85] transition">
            Masuk
        </a>

        <a href="#" class="px-[26px] py-[11px] text-[14px] font-semibold rounded-[12px] bg-[#C82D85] text-white shadow-[0_8px_24px_rgba(200,45,133,0.35)] hover:bg-[#951651] hover:shadow-[0_14px_36px_rgba(200,45,133,0.5)] hover:-translate-y-[2px] hover:scale-[1.02] active:scale-[0.98] transition">
            Daftar
        </a>
    </div>
</header>

<!-- HERO -->
<section class="grid md:grid-cols-[1.15fr_0.85fr] items-center gap-[40px] px-6 md:px-12 py-[48px]">

    <div class="animate-[fadeUp_0.7s_ease]">
        <h1 class="text-[clamp(2rem,3.8vw,3.4rem)] leading-[1.22] font-extrabold mb-[20px] tracking-[-0.5px]">
            Belajar <span class="text-[#C82D85]">Bahasa Isyarat</span><br>
            Dengan AI Secara<br>
            Mandiri
        </h1>

        <p class="text-[1.25rem] leading-[1.85] text-[#7A4B78] mb-[32px] max-w-[550px]">
            Aplikasi cerdas berbasis AI untuk belajar dan melatih bahasa isyarat
            dengan mudah dan menyenangkan.
        </p>

        <div class="flex gap-[14px] flex-wrap">
            <a href="#" class="px-[26px] py-[11px] rounded-[12px] bg-white text-[#C82D85] border-[1.5px] border-[#F7C4DF] hover:bg-[#F7DAED] shadow transition">
                Mulai Belajar
            </a>

            <a href="#" class="px-[26px] py-[11px] rounded-[12px] bg-[#C82D85] text-white shadow-[0_8px_24px_rgba(200,45,133,0.35)] hover:bg-[#951651] transition">
                Coba Latihan
            </a>
        </div>
    </div>

    <div class="relative flex items-center justify-center min-h-[400px]">

        <!-- glow -->
        <div class="absolute w-[330px] h-[330px] rounded-full bg-[radial-gradient(circle,#F7DAED_0%,transparent_70%)]"></div>

        <img src="{{ asset('assets/hero-illustration.png') }}"
             class="relative max-w-[440px] drop-shadow-[0_24px_40px_rgba(200,45,133,0.2)] animate-[heroFloat_5s_ease-in-out_infinite]">


    </div>
</section>

<!-- FEATURES -->
<section class="px-6 md:px-12">

    <div class="bg-[#FEF1F9] rounded-[28px] shadow-[0_6px_22px_rgba(200,45,133,0.13)] p-[48px_36px] mb-[40px]">

        <h2 class="text-center text-[2rem] font-bold mb-[36px] tracking-[-0.3px]">
            Fitur Utama SIGNLEARN
        </h2>

        <div class="grid md:grid-cols-3 gap-[24px]">

            <!-- CARD -->
            <div class="bg-[#FEF1F9] rounded-[18px] p-[30px_24px] text-center 
                        shadow-[0_6px_22px_rgba(200,45,133,0.13)]
                        flex flex-col items-center justify-between
                        hover:-translate-y-[8px] hover:scale-[1.02] 
                        hover:shadow-[0_18px_48px_rgba(250,150,200,0.65)] transition">

                <h3 class="text-[1.4rem] font-semibold text-[#BE3B7A] mb-[16px] min-h-[60px] flex items-center justify-center">
                    Modul Pembelajaran
                </h3>

                <img src="{{ asset('assets/feature-1.png') }}"
                     class="w-[120px] h-[120px] object-contain mb-[16px]">

                <p class="text-[1.05rem] text-[#492F48] leading-[1.7]">
                    Belajar bahasa isyarat SIBI dan BISINDO melalui modul dan video tutorial.
                </p>
            </div>

            <!-- CARD -->
            <div class="bg-[#FEF1F9] rounded-[18px] p-[30px_24px] text-center 
                        shadow-[0_6px_22px_rgba(200,45,133,0.13)]
                        flex flex-col items-center justify-between
                        hover:-translate-y-[8px] hover:scale-[1.02] 
                        hover:shadow-[0_18px_48px_rgba(250,150,200,0.65)] transition">

                <h3 class="text-[1.4rem] font-semibold text-[#BE3B7A] mb-[16px] min-h-[60px] flex items-center justify-center">
                    Latihan gesture berbasis AI
                </h3>

                <img src="{{ asset('assets/feature-2.png') }}"
                     class="w-[120px] h-[120px] object-contain mb-[16px]">

                <p class="text-[1.05rem] text-[#492F48] leading-[1.7]">
                    Latihan gesture tangan menggunakan kamera yang dianalisis oleh AI.
                </p>
            </div>

            <!-- CARD -->
            <div class="bg-[#FEF1F9] rounded-[18px] p-[30px_24px] text-center 
                        shadow-[0_6px_22px_rgba(200,45,133,0.13)]
                        flex flex-col items-center justify-between
                        hover:-translate-y-[8px] hover:scale-[1.02] 
                        hover:shadow-[0_18px_48px_rgba(250,150,200,0.65)] transition">

                <h3 class="text-[1.4rem] font-semibold text-[#BE3B7A] mb-[16px] min-h-[60px] flex items-center justify-center">
                    Riwayat Pembelajaran
                </h3>

                <img src="{{ asset('assets/feature-3.png') }}"
                     class="w-[120px] h-[120px] object-contain mb-[16px]">

                <p class="text-[1.05rem] text-[#492F48] leading-[1.7]">
                    Melihat skor dan perkembangan latihan sebelumnya.
                </p>
            </div>

        </div>
    </div>
</section>

<!-- CTA -->
<section class="px-6 md:px-12 pb-[56px]">

    <div class="bg-[#FEF1F9] rounded-[28px] shadow-[0_6px_22px_rgba(200,45,133,0.13)] p-[52px_32px] text-center relative overflow-hidden hover:shadow-[0_18px_48px_rgba(250,150,200,0.65)] hover:-translate-y-[4px] transition">

        <div class="absolute w-[300px] h-[300px] border-[60px] border-[#F7DAED] rounded-full right-[-80px] top-[-80px] opacity-45"></div>

        <h2 class="text-[1.85rem] font-bold mb-[28px] relative z-10">
            Mulai Belajar Bahasa Isyarat Sekarang <span class="text-[#C82D85]">›</span>
        </h2>

        <div class="flex justify-center gap-[16px] flex-wrap relative z-10">
            <a href="#" class="px-[32px] py-[14px] min-w-[180px] rounded-[18px] border-2 border-[#742958] text-[#742958] hover:bg-[#F7DAED] transition">
                Masuk
            </a>

            <a href="#" class="px-[32px] py-[14px] min-w-[180px] rounded-[18px] bg-[#C82D85] text-white hover:bg-[#951651] transition">
                Daftar Sekarang
            </a>
        </div>
    </div>
</section>

</div>
</body>
</html>