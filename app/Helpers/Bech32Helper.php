<?php

namespace App\Helpers;

use App\Helpers;

class Bech32Helper extends Helper{
    /**
     * Convert a Nostr npub (Bech32 encoded public key) to a hexadecimal string.
     *
     * @param string $npub The Bech32-encoded public key (starts with 'npub1...')
     * @return string|null Returns the hex public key or null if decoding fails.
     */
    public static function npubToHex(string $npub): ?string
    {
        // Strip prefix and checksum
        $decoded = self::bech32Decode($npub);

        if (!$decoded || $decoded['prefix'] !== 'npub') {
            return null; // Invalid npub key
        }

        // Convert 5-bit words to 8-bit bytes
        $bytes = self::convertBits($decoded['data'], 5, 8, false);

        if ($bytes === null) {
            return null; // Bit conversion failed
        }

        return bin2hex(pack('C*', ...$bytes));
    }

    /**
     * Decode a Bech32 string.
     *
     * @param string $bech The bech32 encoded string.
     * @return array|null Returns ['prefix' => string, 'data' => array] or null on failure.
     */
    protected static function bech32Decode(string $bech): ?array
    {
        $charset = 'qpzry9x8gf2tvdw0s3jn54khce6mua7l';
        $bech = strtolower($bech);
        $pos = strrpos($bech, '1');

        if ($pos === false || $pos < 1 || $pos + 7 > strlen($bech)) {
            return null;
        }

        $prefix = substr($bech, 0, $pos);
        $data = [];

        for ($i = $pos + 1; $i < strlen($bech); $i++) {
            $d = strpos($charset, $bech[$i]);
            if ($d === false) return null;
            $data[] = $d;
        }

        return ['prefix' => $prefix, 'data' => array_slice($data, 0, -6)]; // Strip checksum
    }

    /**
     * Convert data between bit sizes.
     *
     * @param array $data Input data as array of integers.
     * @param int $fromBits Number of bits per input element.
     * @param int $toBits Number of bits per output element.
     * @param bool $pad Whether to pad the result.
     * @return array|null Returns the converted data or null on error.
     */
    protected static function convertBits(array $data, int $fromBits, int $toBits, bool $pad = true): ?array
    {
        $acc = 0;
        $bits = 0;
        $ret = [];
        $maxv = (1 << $toBits) - 1;

        foreach ($data as $value) {
            if ($value < 0 || $value >> $fromBits) {
                return null;
            }
            $acc = ($acc << $fromBits) | $value;
            $bits += $fromBits;
            while ($bits >= $toBits) {
                $bits -= $toBits;
                $ret[] = ($acc >> $bits) & $maxv;
            }
        }

        if ($pad && $bits > 0) {
            $ret[] = ($acc << ($toBits - $bits)) & $maxv;
        } elseif ($bits >= $fromBits || (($acc << ($toBits - $bits)) & $maxv)) {
            return null;
        }

        return $ret;
    }

}
