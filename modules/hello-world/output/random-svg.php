<?php

declare(strict_types=1);

namespace Darling\Modules\HelloWorld;

/**
 * ArtGenerator Class
 * Features: Perspective, Z-Sorting, Size-to-Pitch Audio, and Interactive Bouncing.
 */
class ArtGenerator
{
    private int $width = 800;
    private int $height = 600;

    /** @var array<int, array<int, string>> */
    private array $colors = [
        ['#6366f1', '#4338ca'], // Indigo
        ['#ec4899', '#be185d'], // Pink
        ['#f59e0b', '#b45309'], // Amber
        ['#10b981', '#047857'], // Emerald
        ['#f43f5e', '#be123c'], // Rose
    ];

    public function generate(): string
    {
        $cubeData = [];
        $numShapes = random_int(40, 60);

        for ($i = 0; $i < $numShapes; ++$i) {
            $rawY = random_int(100, $this->height - 50);
            $perspectiveScale = $rawY / $this->height;

            $centerX = $this->width / 2;
            $rawX = random_int(50, $this->width - 50);
            $distFromCenter = $rawX - $centerX;
            $adjustedX = $centerX + ($distFromCenter * $perspectiveScale);
            $size = random_int(20, 70) * $perspectiveScale;

            // Map size to frequency: Smaller size = Higher frequency
            // Range: ~261Hz (Middle C) to ~523Hz (C5)
            $freq = 523.25 - (($size / 70) * (523.25 - 261.63));

            $cubeData[] = [
                'x' => $adjustedX,
                'y' => $rawY,
                'size' => $size,
                'freq' => $freq,
                'theme' => $this->colors[array_rand($this->colors)],
                'opacity' => 0.5 + (0.5 * $perspectiveScale),
            ];
        }

        usort($cubeData, fn (array $a, array $b): int => $a['y'] <=> $b['y']);

        $shapes = array_map(function (array $data): string {
            /** @var array<int, string> $theme */
            $theme = $data['theme'];

            return $this->drawIsometricCube(
                (int) $data['x'],
                (int) $data['y'],
                (int) $data['size'],
                (float) $data['freq'],
                $theme,
                (float) $data['opacity']
            );
        }, $cubeData);

        return sprintf(
            '<svg id="art-svg" width="100%%" height="100%%" viewBox="0 0 %d %d" xmlns="http://www.w3.org/2000/svg" style="background:#0f172a; display:block;">
                %s
            </svg>',
            $this->width,
            $this->height,
            implode('', $shapes)
        );
    }

    public function renderBodyContent(): void
    {
        $svg = $this->generate();
        echo <<<CONTENT
                <style>
                    .art-wrapper { position: relative; width: 100%; height: 95vh; background: #0f172a; display: flex; justify-content: center; align-items: center; overflow: hidden; }
                    .iso-cube { transition: filter 0.3s ease; cursor: pointer; }
                    .iso-cube .cube-shadow { transform-origin: center; }

                    @keyframes bob-once { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-15px); } }
                    @keyframes bob-loop { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-30px); } }
                    @keyframes shadow-loop { 0%, 100% { transform: scale(1); opacity: 0.25; } 50% { transform: scale(0.7); opacity: 0.1; } }

                    .iso-cube:not(.is-bouncing):hover .cube-faces { animation: bob-once 0.6s ease-out; filter: brightness(1.2); }
                    .iso-cube.is-bouncing .cube-faces { animation: bob-loop 1.5s infinite ease-in-out; filter: brightness(1.1); }
                    .iso-cube.is-bouncing .cube-shadow { animation: shadow-loop 1.5s infinite ease-in-out; }

                    .art-controls { position: absolute; bottom: 2rem; right: 2rem; z-index: 10; color: white; background: rgba(15, 23, 42, 0.9); padding: 1.25rem; border-radius: 12px; font-family: system-ui, sans-serif; border: 1px solid #1e293b; box-shadow: 0 10px 25px rgba(0,0,0,0.5); width: 220px; }
                    .btn { cursor: pointer; border: none; color: white; padding: 10px; border-radius: 6px; font-weight: bold; width: 100%; margin-top: 8px; }
                    .btn-primary { background: #6366f1; }
                    .btn-secondary { background: #475569; }
                    small { color: #94a3b8; display: block; margin-bottom: 10px; font-size: 0.85rem; line-height: 1.4; }
                </style>

                <div class="art-wrapper">
                    <div class="art-controls">
                        <strong>Generative Synth</strong>
                        <small>• Frequency tied to cube size<br>• Hover for light tap<br>• Click for deep resonant pop</small>
                        <button class="btn btn-secondary" onclick="resetAllBounces()">Reset All</button>
                        <button class="btn btn-primary" onclick="window.location.reload()">New Art</button>
                    </div>
                    {$svg}
                </div>

                <script>
                    const audioCtx = new (window.AudioContext || window.webkitAudioContext)();

                    function playNote(frequency, duration) {
                        if (audioCtx.state === 'suspended') { audioCtx.resume(); }

                        const oscillator = audioCtx.createOscillator();
                        const gainNode = audioCtx.createGain();

                        // Slightly warmer sound using 'triangle' wave for click resonance
                        oscillator.type = duration > 0.1 ? 'triangle' : 'sine';
                        oscillator.frequency.setValueAtTime(frequency, audioCtx.currentTime);

                        gainNode.gain.setValueAtTime(0.05, audioCtx.currentTime);
                        gainNode.gain.exponentialRampToValueAtTime(0.0001, audioCtx.currentTime + duration);

                        oscillator.connect(gainNode);
                        gainNode.connect(audioCtx.destination);

                        oscillator.start();
                        oscillator.stop(audioCtx.currentTime + duration);
                    }

                    function handleCubeClick(element, frequency) {
                        playNote(frequency, 0.5);
                        element.classList.toggle('is-bouncing');
                    }

                    function resetAllBounces() {
                        document.querySelectorAll('.is-bouncing').forEach(cube => cube.classList.remove('is-bouncing'));
                    }
                </script>
            CONTENT;
    }

    /**
     * @param array<int, string> $theme
     */
    private function drawIsometricCube(int $x, int $y, int $size, float $freq, array $theme, float $opacity): string
    {
        $bright = (string) ($theme[0] ?? '#ffffff');
        $dark = (string) ($theme[1] ?? '#000000');

        $top = "{$x},{$y} " . ($x + $size) . ',' . ($y - $size / 2) . ' ' . ($x + $size * 2) . ",{$y} " . ($x + $size) . ',' . ($y + $size / 2);
        $left = "{$x},{$y} " . ($x + $size) . ',' . ($y + $size / 2) . ' ' . ($x + $size) . ',' . ($y + $size * 1.5) . " {$x}," . ($y + $size);
        $right = ($x + $size) . ',' . ($y + $size / 2) . ' ' . ($x + $size * 2) . ",{$y} " . ($x + $size * 2) . ',' . ($y + $size) . ' ' . ($x + $size) . ',' . ($y + $size * 1.5);

        $shadowX = $x + $size;
        $shadowY = $y + ($size * 1.5);

        return "
            <g class='iso-cube' style='opacity: {$opacity}'
               onmouseenter='playNote({$freq}, 0.1)'
               onclick='handleCubeClick(this, {$freq})'>
                <ellipse class='cube-shadow' cx='{$shadowX}' cy='{$shadowY}' rx='{$size}' ry='" . ($size / 3) . "' fill='black' fill-opacity='0.25' />
                <g class='cube-faces'>
                    <polygon points='{$top}' fill='{$bright}' />
                    <polygon points='{$left}' fill='{$dark}' fill-opacity='0.8' />
                    <polygon points='{$right}' fill='{$dark}' fill-opacity='0.6' />
                </g>
            </g>";
    }
}

$generator = new ArtGenerator();
$generator->renderBodyContent();
