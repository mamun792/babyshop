<?php

namespace App\Services;

use App\Models\AffiliateRegistration;
use Illuminate\Support\Str;

class ReferralCodeService
{
    private const PREFIX = 'AFF';
   
    /**
     * Generate a unique referral code based on the user ID.
     *
     * @param int $userId
     * @return string
     * @throws \Exception
     */
    public function generateReferralCode(int $userId): string
    {
        $baseCode = self::PREFIX . str_pad($userId, 4, '0', STR_PAD_LEFT);
        
        
        $hash = substr(hash_hmac('sha256', $userId, config('app.key')), 0, 6);
    
       
        $referCode = $baseCode . '-' . strtoupper($hash);
    
        
        $maxAttempts = 5;
        for ($attempt = 0; $attempt < $maxAttempts; $attempt++) {
            if (!AffiliateRegistration::where('refer_code', $referCode)->exists()) {
                
                return $referCode;
            }
    
            
            $hash = substr(hash_hmac('sha256', $userId . mt_rand(), config('app.key')), 0, 6);
            $referCode = $baseCode . '-' . strtoupper($hash);
        }
    
        throw new \Exception('Unable to generate a unique referral code after multiple attempts.');
    }
    
    
}
