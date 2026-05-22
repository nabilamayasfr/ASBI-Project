@foreach($riwayat as $item)
  <div class="riwayat-item bg-white rounded-[20px] px-[22px] py-[18px] flex items-center gap-4
              shadow-[0_4px_18px_rgba(200,45,133,0.08)] border-[1.5px] border-[#F7DAED]
              cursor-pointer transition-all duration-[220ms]
              hover:-translate-y-[3px] hover:scale-[1.01] hover:shadow-[0_12px_32px_rgba(200,45,133,0.18)]
              hover:border-[#E8A0CE]"
       data-tipe="{{ $item['tipe'] }}"
       onclick="bukaModal({{ json_encode($item) }})">

    <div class="w-[52px] h-[52px] rounded-[14px] shrink-0 flex items-center justify-center
                bg-[linear-gradient(135deg,_#F1A2D0,_#C82D85)]
                shadow-[0_3px_6px_rgba(200,45,133,0.25)]">
      <span class="text-[1.6rem]">{{ $item['tipe'] === 'kuis' ? '📝' : '🤟' }}</span>
    </div>

    <div class="flex-1 min-w-0">
      <h3 class="text-[1rem] font-bold text-[#492F48] mb-[3px]">{{ $item['judul'] }}</h3>
      <span class="text-[0.83rem] text-[#9B6898] font-medium">{{ $item['subjudul'] }}</span>
    </div>

    <div class="flex items-center gap-1.5 shrink-0">
      <span class="px-3.5 py-1.5 rounded-full bg-[#C82D85] text-white text-[0.82rem] font-bold
                   shadow-[0_4px_12px_rgba(200,45,133,0.28)]">✅ {{ $item['benar'] }}</span>
      <span class="px-3.5 py-1.5 rounded-full bg-[#F7DAED] text-[#C82D85] text-[0.82rem] font-bold
                   border-[1.5px] border-[#F0B8D8]">❌ {{ $item['salah'] }}</span>
    </div>

  </div>
@endforeach