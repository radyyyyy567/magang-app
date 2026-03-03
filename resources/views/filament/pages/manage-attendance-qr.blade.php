<x-filament::page>
    <div 
        class="flex flex-col items-center justify-center p-6 bg-white rounded-xl shadow-sm "
        x-data="{
            qrSrc: '',
            updateQR() {
                const secret = 'MAGANG_SECRET_KEY_2024';
                // Use server time ideally, but local time for demo match
                // Logic must match ScanAttendance.php
                const timestamp = Math.floor(Date.now() / 1000);
                const slot = Math.floor(timestamp / 5);
                
                // SHA-256 of secret + slot
                // We use a simple lightweight crypto approach or external API for display if JS crypto is robust enough.
                // Using Web Crypto API
                
                const msgBuffer = new TextEncoder().encode(secret + slot);
                crypto.subtle.digest('SHA-256', msgBuffer).then(hashBuffer => {
                   const hashArray = Array.from(new Uint8Array(hashBuffer));
                   const hashHex = hashArray.map(b => b.toString(16).padStart(2, '0')).join('');
                   
                   // Using a public QR API for simplicity in this demo. 
                   // In production, use a local QR library (like qrcode.js) to avoid leaking the hash/secret.
                   this.qrSrc = `https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=${hashHex}`;
                });
            }
        }"
        x-init="
            updateQR();
            setInterval(() => updateQR(), 5000);
        "
    >
        <h2 class="text-xl font-bold mb-4 text-white">Scan untuk Absensi</h2>
        <p class=" mb-6">QR Code berubah setiap 5 detik</p>
        
        <div class="relative flex justify-center w-full ">
            <template x-if="qrSrc" class>
                <img :src="qrSrc" alt="QR Code" class="w-64 h-64     rounded-lg">
            </template>
            <template x-if="!qrSrc">
                <div class="w-64 h-64 border rounded-lg flex items-center justify-center bg-gray-100 dark:bg-gray-700">
                    Loading...
                </div>
            </template>
        </div>
        
        <p class="mt-4 text-sm text-gray-400">Pastikan jam perangkat sinkron.</p>
    </div>
</x-filament::page>
