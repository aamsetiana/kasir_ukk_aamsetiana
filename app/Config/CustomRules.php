namespace App\Validation\Rules;

use CodeIgniter\Validation\Rules;

class CustomRules
{
    public function jualHigherThanBeli(string $str, string $fields, array $data): bool
    {
        // Ambil nilai harga beli
        $hargaBeli = $data[$fields];

        // Bandingkan harga jual dengan harga beli
        return $str >= $hargaBeli;
    }
}
