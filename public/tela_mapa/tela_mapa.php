<?php
include '../templates/sidebar.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GordoSensores — Sensores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../styles/style.css">
    <link rel="stylesheet" href="../../styles/ferrovia.css">
</head>
 
<body>
    <?php include '../templates/sidebar.php'; ?>
 
    <div class="conteudo-ferrovia">
        <div class="pista">
 
            <svg id="ferrorama" viewBox="0 0 480 480" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Ferrovia Ferrorama XP 500">
                <defs>
                    <!-- Percursos (mesmo sistema de coordenadas da foto: 480x480) -->
                    <path id="r1" d="M80 335 C80 290 102 250 104 200 C106 140 112 90 145 48 C172 15 225 8 258 32 C285 12 340 12 372 45 C398 75 396 120 388 160 C380 205 355 240 335 265 C305 300 285 325 283 370 C282 415 240 445 190 462 C130 478 70 440 70 380 C70 360 76 348 80 335Z" />
                    <path id="r2" d="M258 32 C225 45 205 80 210 115 C215 160 222 215 216 270 C212 310 214 345 232 382 C255 420 310 418 355 405 C415 385 445 345 432 295 C425 255 398 225 385 185 C380 160 392 110 372 45 C340 12 285 12 258 32Z" />
                    <path id="r3" d="M210 105 C185 130 150 160 148 205 C146 250 175 275 175 320" />
 
                    <mask id="corte-preto" maskUnits="userSpaceOnUse" x="0" y="0" width="480" height="480">
                        <rect width="480" height="480" fill="#fff" />
                        <use href="#r1" fill="none" stroke="#000" stroke-width="5.4" />
                        <use href="#r3" fill="none" stroke="#000" stroke-width="5.4" />
                    </mask>
                    <mask id="corte-cinza" maskUnits="userSpaceOnUse" x="0" y="0" width="480" height="480">
                        <rect width="480" height="480" fill="#fff" />
                        <use href="#r2" fill="none" stroke="#000" stroke-width="5.4" />
                    </mask>
 
                    <g id="rocha">
                        <path d="M-13 9 L-9 -8 L4 -11 L13 9Z" fill="#7a4a2a" stroke="#4d2c16" stroke-width="1" />
                    </g>
                </defs>
 
                <!-- Foto de referência (opcional, para calibrar os trilhos) -->
                <image id="foto" href="../../img/ferrorama_xp500.png" x="0" y="0" width="480" height="480" opacity="0.35" style="display:none" />
 
                <!-- Circuito cinza (direita) -->
                <use href="#r2" fill="none" stroke="#555" stroke-width="10" />
                <use href="#r2" fill="none" stroke="#aaa" stroke-width="9" stroke-dasharray="2.2 3.2" />
                <use href="#r2" fill="none" stroke="#e0e0e0" stroke-width="8" mask="url(#corte-cinza)" />
 
                <!-- Circuito externo e ramal interno (pretos) -->
                <g id="rede-preta">
                    <use href="#r1" fill="none" stroke="#1e1e1e" stroke-width="10" />
                    <use href="#r3" fill="none" stroke="#1e1e1e" stroke-width="10" />
                    <use href="#r1" fill="none" stroke="#777" stroke-width="9" stroke-dasharray="2.2 3.2" />
                    <use href="#r3" fill="none" stroke="#777" stroke-width="9" stroke-dasharray="2.2 3.2" />
                    <use href="#r1" fill="none" stroke="#bfc4c9" stroke-width="8" mask="url(#corte-preto)" />
                    <use href="#r3" fill="none" stroke="#bfc4c9" stroke-width="8" mask="url(#corte-preto)" />
                </g>
 
                <!-- Montanhas -->
                <use href="#rocha" x="145" y="45" />
                <use href="#rocha" x="211" y="20" />
                <use href="#rocha" x="262" y="42" />
                <use href="#rocha" x="128" y="78" />
                <use href="#rocha" x="272" y="192" />
                <use href="#rocha" x="250" y="250" />
                <use href="#rocha" x="410" y="318" />
                <use href="#rocha" x="388" y="382" />
                <use href="#rocha" x="320" y="408" />
                <use href="#rocha" x="238" y="388" />
 
                <!-- Ponte (passagem elevada) -->
                <g transform="translate(274 152) rotate(-4)">
                    <rect x="-11" y="-48" width="22" height="96" fill="#dfe3e6" stroke="#777" />
                    <path d="M-11 -48 L11 -30 M-11 -30 L11 -12 M-11 -12 L11 6 M-11 6 L11 24 M-11 24 L11 42" stroke="#777" fill="none" />
                    <rect x="-3" y="-48" width="6" height="96" fill="#555" />
                </g>
 
                <!-- Estação / chave -->
                <rect x="58" y="312" width="38" height="46" fill="#1d1d1d" />
                <rect x="64" y="318" width="6" height="32" fill="#f2c200" />
                <rect x="76" y="318" width="10" height="10" fill="#d33" />
 
                <!-- Trem: 3 vagões + locomotiva (a locomotiva vai por último no DOM para ficar por cima) -->
                <g id="trem">
                    <g class="vagao"><rect x="-6" y="-3.5" width="12" height="7" rx="1.5" fill="#111" stroke="#ccc" stroke-width=".7" /></g>
                    <g class="vagao"><rect x="-6" y="-3.5" width="12" height="7" rx="1.5" fill="#111" stroke="#ccc" stroke-width=".7" /></g>
                    <g class="vagao"><rect x="-6" y="-3.5" width="12" height="7" rx="1.5" fill="#111" stroke="#ccc" stroke-width=".7" /></g>
                    <g class="loco">
                        <rect x="-7" y="-4" width="14" height="8" rx="2" fill="#f2c200" stroke="#222" stroke-width=".8" />
                        <rect x="-1" y="-4" width="5" height="8" fill="#222" />
                    </g>
                </g>
            </svg>
 
            <div class="controles">
                <button id="btn-pausa" class="btn btn-dark btn-sm">Pausar</button>
                <button id="btn-inverter" class="btn btn-outline-dark btn-sm">Inverter sentido</button>
                <select id="sel-rota" class="form-select form-select-sm">
                    <option value="r1">Circuito externo</option>
                    <option value="r2">Circuito direito</option>
                    <option value="r3">Ramal interno (vai e volta)</option>
                </select>
                <label class="small"><input type="checkbox" id="chk-foto"> Foto de referência</label>
            </div>
 
            <script>
                window.addEventListener('load', function () {
                    const rotas = {};
                    ['r1', 'r2', 'r3'].forEach(id => {
                        const el = document.getElementById(id);
                        rotas[id] = {
                            el,
                            len: el.getTotalLength(),
                            fechada: /Z\s*$/i.test(el.getAttribute('d'))
                        };
                    });
 
                    // Loco (último no DOM) vai na frente, depois os vagões
                    const cars = [...document.querySelectorAll('#trem .loco, #trem .vagao')];
                    const ordem = [cars[cars.length - 1], ...cars.slice(0, -1)];
 
                    const espaco = 15;      // distância entre os carros
                    const velocidade = 60;  // unidades do SVG por segundo
 
                    let rota = rotas.r1;
                    let d = 0, sentido = 1, rodando = true, ultimo = null;
                    const mod = (a, n) => ((a % n) + n) % n;
 
                    function posicionar(car, s) {
                        const { el, len, fechada } = rota;
                        let u, dir = 1;
 
                        if (fechada) {
                            u = mod(s, len);
                        } else {
                            // percurso aberto: vai até a ponta e volta
                            const m = mod(s, 2 * len);
                            if (m <= len) { u = m; } else { u = 2 * len - m; dir = -1; }
                        }
 
                        const p = el.getPointAtLength(u);
                        const a = el.getPointAtLength(fechada ? mod(u + 0.5, len) : Math.min(len, u + 0.5));
                        const b = el.getPointAtLength(fechada ? mod(u - 0.5, len) : Math.max(0, u - 0.5));
 
                        let ang = Math.atan2(a.y - b.y, a.x - b.x) * 180 / Math.PI;
                        if (dir * sentido < 0) ang += 180;
 
                        car.setAttribute('transform', 'translate(' + p.x + ' ' + p.y + ') rotate(' + ang + ')');
                    }
 
                    function quadro(t) {
                        if (ultimo !== null && rodando) {
                            d += sentido * velocidade * (t - ultimo) / 1000;
                        }
                        ultimo = t;
                        ordem.forEach((car, i) => posicionar(car, d - i * espaco * sentido));
                        requestAnimationFrame(quadro);
                    }
                    requestAnimationFrame(quadro);
 
                    document.getElementById('btn-pausa').onclick = function (e) {
                        rodando = !rodando;
                        e.target.textContent = rodando ? 'Pausar' : 'Retomar';
                    };
                    document.getElementById('btn-inverter').onclick = function () { sentido *= -1; };
                    document.getElementById('sel-rota').onchange = function (e) {
                        rota = rotas[e.target.value];
                        d = 0;
                    };
                    document.getElementById('chk-foto').onchange = function (e) {
                        document.getElementById('foto').style.display = e.target.checked ? 'block' : 'none';
                    };
                });
            </script>
 
        </div>
    </div>
</body>
 
</html>