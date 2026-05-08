<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calculadora</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white rounded-2xl shadow-lg p-6 w-96">

        {{-- Pantallas --}}
        <div class="grid grid-cols-5 gap-2 items-end mb-4">
            <div class="col-span-2">
                <p class="text-xs text-gray-400 text-center mb-1">N = 1</p>
                <div id="scr1" class="border rounded-lg p-2 text-right text-xl font-mono min-h-[44px] bg-gray-50">0</div>
            </div>
            <div id="opDisplay" class="text-center text-2xl text-gray-400 pb-2 font-mono">·</div>
            <div>
                <p class="text-xs text-gray-400 text-center mb-1">N = 2</p>
                <div id="scr2" class="border rounded-lg p-2 text-right text-xl font-mono min-h-[44px] bg-gray-50">0</div>
            </div>
            <div class="flex items-end">
                <button onclick="enviarAlServidor()"
                        class="bg-blue-100 text-blue-700 rounded-lg w-10 h-11 text-xl font-bold hover:bg-blue-200 transition">
                    =
                </button>
            </div>
        </div>

        {{-- Resultado --}}
        <div class="mb-4">
            <p class="text-xs text-gray-400 text-center mb-1">Resultado</p>
            <div id="scrR" class="border rounded-lg p-2 text-right text-lg font-mono bg-gray-50 min-h-[40px]">—</div>
        </div>

        {{-- Error --}}
        <div id="errorMsg" class="hidden mb-3 text-sm text-red-500 text-center bg-red-50 rounded-lg py-2"></div>

        {{-- Teclado --}}
        <div class="grid grid-cols-6 gap-2">
            @foreach([
                ['7','8','9','%','÷','×'],
                ['4','5','6','−','+','C'],
                ['1','2','3','0','√n','xⁿ'],
            ] as $fila)
                @foreach($fila as $tecla)
                    @php
                        $estilo = match(true) {
                            in_array($tecla, ['%','÷','×','−','+']) => 'bg-blue-50 text-blue-700 hover:bg-blue-100',
                            $tecla === 'C'                           => 'bg-red-50 text-red-600 hover:bg-red-100',
                            in_array($tecla, ['√n','xⁿ'])           => 'bg-amber-50 text-amber-700 hover:bg-amber-100',
                            default                                  => 'bg-gray-50 text-gray-800 hover:bg-gray-100',
                        };
                    @endphp
                    <button onclick="handleBtn('{{ $tecla }}')"
                            class="{{ $estilo }} border rounded-lg h-12 text-base font-mono font-medium active:scale-95 transition-all">
                        {{ $tecla }}
                    </button>
                @endforeach
            @endforeach
        </div>

        {{-- Indicador de carga --}}
        <div id="loader" class="hidden text-center text-xs text-gray-400 mt-3">Calculando...</div>
    </div>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const opMap     = { '÷': '/', '×': '*', '−': '-', '+': '+', '%': '%', '√n': 'sqrt', 'xⁿ': 'pow' };

        let estado = { n1: '', n2: '', op: null, activo: 1 };

        function actualizarPantallas() {
            document.getElementById('scr1').textContent     = estado.n1 || '0';
            document.getElementById('scr2').textContent     = estado.n2 || '0';
            document.getElementById('opDisplay').textContent = estado.op || '·';
        }

        function handleBtn(tecla) {
            document.getElementById('errorMsg').classList.add('hidden');

            if (!isNaN(tecla) || tecla === '.') {
                if (estado.activo === 1) {
                    estado.n1 = (estado.n1 === '0' && tecla !== '.') ? tecla : estado.n1 + tecla;
                } else {
                    estado.n2 = (estado.n2 === '0' && tecla !== '.') ? tecla : estado.n2 + tecla;
                }
            } else if (tecla === 'C') {
                estado = { n1: '', n2: '', op: null, activo: 1 };
                document.getElementById('scrR').textContent = '—';
            } else if (tecla === '√n') {
                estado.op    = '√n';
                estado.activo = 2;
                enviarAlServidor();
                return;
            } else if (tecla === 'xⁿ') {
                estado.op    = 'xⁿ';
                estado.activo = 2;
            } else {
                estado.op    = tecla;
                estado.activo = 2;
            }

            actualizarPantallas();
        }

        async function enviarAlServidor() {
            const n1 = parseFloat(estado.n1) || 0;
            const n2 = parseFloat(estado.n2) || 0;
            const op = opMap[estado.op] ?? null;

            if (!op) return;

            document.getElementById('loader').classList.remove('hidden');
            document.getElementById('scrR').textContent = '…';

            try {
                const res = await fetch("{{ route('calculadora.calcular') }}", {
                    method:  'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept':       'application/json',
                    },
                    body: JSON.stringify({ n1, n2, op }),
                });

                const data = await res.json();

                if (!res.ok) {
                    mostrarError(data.error ?? 'Error desconocido');
                } else {
                    document.getElementById('scrR').textContent = data.resultado;
                }
            } catch (e) {
                mostrarError('Error de conexión con el servidor');
            } finally {
                document.getElementById('loader').classList.add('hidden');
            }
        }

        function mostrarError(msg) {
            const el = document.getElementById('errorMsg');
            el.textContent = msg;
            el.classList.remove('hidden');
            document.getElementById('scrR').textContent = '—';
        }

        actualizarPantallas();
    </script>
</body>
</html>