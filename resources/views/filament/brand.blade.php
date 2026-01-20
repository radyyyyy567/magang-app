@php
    $isAdmin = !
    request()->is(
        'admin/login',
        'mentor/login',
        'intern/login',
        'intern/registrasi'
    );
@endphp

<div style="
    display: flex;
    position: relative;
    z-index: 50;
    flex-direction: {{ $isAdmin ? 'row' : 'column' }};
    align-items: center;
    justify-content: center;
    gap: {{ $isAdmin ? '12px' : '12px' }};
    margin-bottom: {{ $isAdmin ? '0' : '-50px' }};
    padding: {{ $isAdmin ? '0' : '50px 0px' }};
    background-color: #fff;
">
    <img
        src="{{ asset('images/logo.png') }}"
        alt="Logo"
        style="
            height: {{ $isAdmin ? '40px' : '96px' }};
            width: auto;
            display: block;
        "
    >

    <div style="
        text-align: {{ $isAdmin ? 'left' : 'center' }};
        line-height: 1.2;
    ">
        <div style="
            font-size: {{ $isAdmin ? '18px' : '32px' }};
            font-weight: 700;
            color: #111827;
            white-space: nowrap;
        ">
            MagangKUM 
        </div>
    </div>
</div>
