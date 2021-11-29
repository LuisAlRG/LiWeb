@extends('layouts.pant')

@section('titleAll','Menu Principal')

@section('title')
	<title>LiWeb Menu</title>
@endsection
@section('style')
	<link rel="stylesheet" href="/css/svgAnimaciones.css">
@endsection
@section('subtitle')
	<p>Menu</p>
@endsection
@section('accinesInputs')

@endsection
@section('botonesAccion')
	<div>
        <h2> Salir de sesion </h2>
        <div class="btnLogOut">
        <a href="Saliendo">
            <button >
                <svg  viewBox="-20 0 120 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M29 10C29 5.58172 32.5817 2 37 2H90C94.4183 2 98 5.58172 98 10V90C98 94.4183 94.4183 98 90 98H37C32.5817 98 29 94.4183 29 90V10Z" fill="black"/>
                    <g class="fondoFalsoLO">
                    	<path d="M40 17C40 14.7909 41.7909 13 44 13H84C86.2091 13 88 14.7909 88 17V83C88 85.2091 86.2091 87 84 87H44C41.7909 87 40 85.2091 40 83V17Z" fill="#008000"/>
                        <rect x="29" y="39" width="15" height="22" fill="#008000"/>
                    </g>
                    <g class="flechaLO">
                        <path d="M2.87868 47.8787C1.70711 49.0503 1.70711 50.9497 2.87868 52.1213L21.9706 71.2132C23.1421 72.3848 25.0416 72.3848 26.2132 71.2132C27.3848 70.0416 27.3848 68.1421 26.2132 66.9706L9.24264 50L26.2132 33.0294C27.3848 31.8579 27.3848 29.9584 26.2132 28.7868C25.0416 27.6152 23.1421 27.6152 21.9706 28.7868L2.87868 47.8787ZM62 47L5 47V53L62 53V47Z" fill="black"/>
                        <path d="M11 45H58C60.7614 45 63 47.2386 63 50V50C63 52.7614 60.7614 55 58 55H11V45Z" fill="black"/>
                    </g>
                </svg>
            </button>
        </a>
    	</div>
    </div>
@endsection
@section('tables')
		<botonesDeRedireccion>
            <div>
                <section>
                    <a href="Venta">
                    <div>
                        <svg  viewBox="104 0 200 150" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect class="texto1D" y="15" width="100" height="15" fill="black" fill-opacity="0.5"/>
                            <rect class="texto5D" x="52" y="113" width="48" height="15" fill="black" fill-opacity="0.5"/>
                            <rect class="texto4D" y="84" width="29" height="15" fill="black" fill-opacity="0.5"/>
                            <rect class="texto3D" y="61" width="83" height="15" fill="black" fill-opacity="0.5"/>
                            <rect class="texto2D" y="38" width="52" height="15" fill="black" fill-opacity="0.5"/>
                            <circle class="sombraD" cx="204.5" cy="75.5" r="52.5" fill="black" fill-opacity="0.45"/>
                            <circle cx="204.5" cy="75.5" r="52.5" fill="white"/>
                            <path class="dinero" d="M210.688 85.0312C210.688 83.3229 210.208 81.9688 209.25 80.9688C208.312 79.9479 206.708 79.0104 204.438 78.1562C202.167 77.3021 200.208 76.4583 198.562 75.625C196.917 74.7708 195.5 73.8021 194.312 72.7188C193.146 71.6146 192.229 70.3229 191.562 68.8438C190.917 67.3646 190.594 65.6042 190.594 63.5625C190.594 60.0417 191.719 57.1562 193.969 54.9062C196.219 52.6562 199.208 51.3438 202.938 50.9688V44.2812H207.938V51.0625C211.625 51.5833 214.51 53.125 216.594 55.6875C218.677 58.2292 219.719 61.5312 219.719 65.5938H210.688C210.688 63.0938 210.167 61.2292 209.125 60C208.104 58.75 206.729 58.125 205 58.125C203.292 58.125 201.969 58.6146 201.031 59.5938C200.094 60.5521 199.625 61.8854 199.625 63.5938C199.625 65.1771 200.083 66.4479 201 67.4062C201.917 68.3646 203.615 69.3438 206.094 70.3438C208.594 71.3438 210.646 72.2917 212.25 73.1875C213.854 74.0625 215.208 75.0625 216.312 76.1875C217.417 77.2917 218.26 78.5625 218.844 80C219.427 81.4167 219.719 83.0729 219.719 84.9688C219.719 88.5104 218.615 91.3854 216.406 93.5938C214.198 95.8021 211.156 97.1042 207.281 97.5V103.719H202.312V97.5312C198.042 97.0729 194.729 95.5625 192.375 93C190.042 90.4167 188.875 86.9896 188.875 82.7188H197.906C197.906 85.1979 198.49 87.1042 199.656 88.4375C200.844 89.75 202.542 90.4062 204.75 90.4062C206.583 90.4062 208.031 89.9271 209.094 88.9688C210.156 87.9896 210.688 86.6771 210.688 85.0312Z" fill="#008000"/>
                        </svg>
                    <p>Venta</p>
                    </div>
                    </a>
                </section>
                <section>
                    <a href="Libros">
                    <div>
                        <svg  viewBox="0 0 200 145" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="26" y="132" width="143" height="6" fill="white"/>
                            <rect x="63" y="18" width="32" height="112" fill="white"/>
                            <rect x="65" y="28" width="28" height="5" fill="#008000"/>
                            <rect x="65" y="112" width="28" height="4" fill="#008000"/>
                            <rect x="63" y="120" width="32" height="2" fill="#008000"/>
                            <g class="libroMovible">
                                <path d="M132 15H102L116 10H146L132 15Z" fill="white"/>
                                <path d="M133 18L133 128.5L146 117.5L146 12.5L133 18Z" fill="white"/>
                            
                                <rect  x="100" y="18" width="32" height="112" fill="white"/>
                                <rect x="102" y="28" width="28" height="5" fill="#008000"/>
                                <rect x="102" y="112" width="28" height="4" fill="#008000"/>
                                <rect x="100" y="120" width="32" height="2" fill="#008000"/>
                            </g>
                            <rect x="26" y="18" width="32" height="112" fill="white"/>
                            <rect x="28" y="28" width="28" height="5" fill="#008000"/>
                            <rect x="28" y="112" width="28" height="4" fill="#008000"/>
                            <rect x="26" y="120" width="32" height="2" fill="#008000"/>
                            <rect x="137" y="18" width="32" height="112" fill="white"/>
                            <rect x="139" y="28" width="28" height="5" fill="#008000"/>
                            <rect x="139" y="112" width="28" height="4" fill="#008000"/>
                            <rect x="137" y="120" width="32" height="2" fill="#008000"/>
                            <path d="M172 14H26L40 7H186L172 14Z" fill="white"/>
                            <path d="M174 16.95L174 156L187 156L187 10L174 16.95Z" fill="white"/>
                            <g class="fondoFalso">
                                <rect x="132" y="15" width="5" height="114" fill="#008000"/>
                                <rect x="100" y="14" width="62" height="4" fill="#008000"/>
                            </g>
                        </svg>
                    <p>Libros</p>
                    </div>
                    </a>
                </section>
                <section>
                    <a href="Historial">
                    <div>
                        <svg  viewBox="0 0 200 150" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path class="marcoR" d="M150 56C150 83.6142 127.614 106 100 106C72.3858 106 50 83.6142 50 56C50 28.3858 72.3858 6 100 6C127.614 6 150 28.3858 150 56ZM55 56C55 80.8528 75.1472 101 100 101C124.853 101 145 80.8528 145 56C145 31.1472 124.853 11 100 11C75.1472 11 55 31.1472 55 56Z" fill="white"/>
                            <circle cx="99.5" cy="55.5" r="42.5" fill="white"/>
                            <rect x="100" y="54" width="36" height="4" fill="#008000"/>
                            <rect x="97.7279" y="57.9706" width="18" height="6" transform="rotate(-135 97.7279 57.9706)" fill="#008000"/>
                            <rect x="43" y="132" width="114" height="13" fill="white"/>
                            <rect class="targetaR" x="3" y="119" width="54" height="30" rx="5" fill="#008000"/>
                            <rect x="43" y="109" width="114" height="20" fill="white"/>
                            <circle cx="100" cy="55" r="5" fill="#008000"/>
                        </svg>
                    <p>Mi Historial de venta</p>
                    </div>
                    </a>
                </section>
                
            </div>
        </botonesDeRedireccion>
@endsection
@section('script')

@endsection
