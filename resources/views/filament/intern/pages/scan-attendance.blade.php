<x-filament::page>
    <div 
        x-data="{
            scanner: null,
            initScanner() {
                if (this.scanner) return;
                this.$nextTick(() => {
                    this.scanner = new Html5QrcodeScanner(
                        'reader', 
                        { fps: 10, qrbox: {width: 250, height: 250} },
                        /* verbose= */ false
                    );
                    this.scanner.render((decodedText, decodedResult) => {
                        console.log(`Scan result: ${decodedText}`);
                        $wire.handleScan(decodedText);
                        // Optional: Pause or stop logic
                    }, (errorMessage) => {
                        // parse error, ignore it.
                    });
                });
            }
        }"
        x-init="initScanner()"
        wire:ignore
    >
        <div id="reader" width="600px"></div>
    </div>

    @push('scripts')
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    @endpush
    
    {{-- Fallback if push scripts doesn't work in this specific layout context instantly --}}
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

</x-filament::page>
