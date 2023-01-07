<div class="flex space-y-4 flex-col ">
    <h2 class="mt-3 text-xl font-bold text-slate-600">Input KAS</h2>
    <form wire:submit.prevent="simpan" class="space-y-2">
        <div class="lg:grid lg:grid-cols-4 lg:gap-2 lg:space-y-0 flex flex-col space-y-4">
            <x-input wire:model.defer="tanggal" label="Tanggal" type="date" />
            <x-inputs.currency label="Jumlah" prefix="Rp " thousands="." decimal="," wire:model.defer="jumlah" />
            <x-input wire:model.defer="keterangan" label="Keterangan" />
        </div>
        <div class="flex justify-start">
            <x-button wire:click.prevent="simpan" positive label="simpan" spinner="simpan" loading-delay="short"
                class="w-auto" type="submit" />
        </div>
    </form>
    <div class="overflow-x-auto relative">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="py-3 px-6">
                        #
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Tanggal
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Jumlah
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Keterangan
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Bendahara
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listTransaksi as $key => $transaksi)
                    <tr
                        class="odd:bg-white even:bg-slate-200 border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-slate-300">
                        <td scope="row"
                            class="py-2 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $listTransaksi->firstItem() + $key }}
                        </td>
                        <td scope="row"
                            class="py-2 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ hariTanggal($transaksi->tanggal) }}
                        </td>
                        <td class="py-2 px-6">
                            {{ rupiah($transaksi->jumlah) }}
                        </td>
                        <td class="py-2 px-6">
                            {{ $transaksi->keterangan }}
                        </td>
                        <td class="py-2 px-6">
                            {{ $transaksi->user->name }}
                        </td>
                        <td class="py-2 px-6">
                            <x-button wire:click.prevent="confirm({{ $transaksi->id }})" negative label="Hapus" />
                        </td>
                    </tr>
                @endforeach
                {{ $listTransaksi->links() }}
                <tr
                    class="odd:bg-white even:bg-slate-200 border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-slate-300">
                    <td scope="row" class="py-2 px-6 font-bold text-gray-900 whitespace-nowrap dark:text-white" colspan="2">
                        TOTAL
                    </td>
                    <td scope="row" class="py-2 px-6 font-bold text-gray-900 whitespace-nowrap dark:text-white" colspan="4">
                        {{ rupiah($listTransaksi->sum('jumlah')) }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="mt-3">
        {{ $listTransaksi->links() }}
    </div>
</div>
