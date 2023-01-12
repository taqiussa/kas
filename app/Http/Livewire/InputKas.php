<?php

namespace App\Http\Livewire;

use App\Models\Transaksi;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class InputKas extends Component
{
    use Actions;
    use WithPagination;

    public $tanggal;
    public $jumlah;
    public $keterangan;

    public function render()
    {
        return view(
            'livewire.input-kas',
            [
                'listTransaksi' => Transaksi::with('user')->paginate(5),
                'total' => Transaksi::sum('jumlah')
            ]
        );
    }

    public function mount()
    {
        $this->tanggal = date('Y-m-d');
    }

    public function simpan()
    {
        $this->validate(
            [
                'tanggal' => 'required',
                'jumlah' => 'required',
            ],
            [
                'tanggal.required' => 'harus diisi',
                'jumlah.required' => 'harus diisi',
            ]
        );

        try {
            Transaksi::create([
                'tanggal' => $this->tanggal,
                'jumlah' => $this->jumlah,
                'user_id' => auth()->user()->id,
                'keterangan' => $this->keterangan
            ]);

            $this->notification()->success(
                $title = 'Berhasil',
                $description = 'Berhasil Simpan Kas'
            );
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function confirm($id): void
    {
        $this->dialog()->confirm([

            'title'       => 'Menghapus Data',
            'description' => 'Anda Yakin ?',
            'acceptLabel' => 'Hapus',
            'method'      => 'delete',
            'params'      => $id,

        ]);
    }

    public function delete($id)
    {
        Transaksi::find($id)->delete();
        $this->notification()->error(
            $title = 'Hapus',
            $description = 'Berhasil Hapus Data'
        );
    }
}
