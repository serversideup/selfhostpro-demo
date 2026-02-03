/**
 * Globe Animation - Vanilla JS port of Self-Host Pro marketing site canvas animation
 * 3D rotating wireframe globe with great circle arc animations
 */

export function initGlobe(canvas) {
    if (!canvas) return null;
    const ctx = canvas.getContext('2d');
    if (!ctx) return null;

    let animationId;
    let width = 0;
    let height = 0;
    let globeRadius = 0;
    let centerX = 0;
    let centerY = 0;
    let rotation = 200; // starting rotation so Americas face forward

    // Developer origin (Hawaiian Islands)
    const origin = { lat: 16.3, lng: -157.8 };

    // Customer destinations worldwide
    const destinations = [
        { lat: 51.5, lng: -0.1 },   // London
        { lat: 48.8, lng: 2.3 },    // Paris
        { lat: 52.5, lng: 13.4 },   // Berlin
        { lat: 35.6, lng: 139.6 },  // Tokyo
        { lat: -33.8, lng: 151.2 }, // Sydney
        { lat: 55.7, lng: 37.6 },   // Moscow
        { lat: 19.4, lng: -99.1 },  // Mexico City
        { lat: -23.5, lng: -46.6 }, // São Paulo
        { lat: 1.3, lng: 103.8 },   // Singapore
        { lat: 28.6, lng: 77.2 },   // New Delhi
        { lat: 37.5, lng: 127.0 },  // Seoul
        { lat: -1.2, lng: 36.8 },   // Nairobi
        { lat: 43.6, lng: -79.3 },  // Toronto
        { lat: 59.3, lng: 18.0 },   // Stockholm
        { lat: 25.2, lng: 55.2 },   // Dubai
        { lat: 35.0, lng: -106.6 }, // Albuquerque
        { lat: 47.6, lng: -122.3 }, // Seattle
        { lat: 40.7, lng: -74.0 },  // New York
        { lat: -34.6, lng: -58.3 }, // Buenos Aires
        { lat: 13.7, lng: 100.5 },  // Bangkok
        { lat: 22.3, lng: 114.1 },  // Hong Kong
        { lat: 41.0, lng: 28.9 },   // Istanbul
        { lat: 45.4, lng: -75.7 },  // Ottawa
        { lat: 33.9, lng: -118.2 }, // Los Angeles
    ];

    const arcs = [];
    const maxArcs = 5;
    let arcTimer = 0;

    function project(lat, lng) {
        const phi = (90 - lat) * Math.PI / 180;
        const theta = (lng + rotation) * Math.PI / 180;
        const x = Math.sin(phi) * Math.cos(theta);
        const y = Math.cos(phi);
        const z = Math.sin(phi) * Math.sin(theta);
        return {
            x: centerX + x * globeRadius,
            y: centerY - y * globeRadius,
            z
        };
    }

    // Interpolate great circle between two lat/lng points
    function greatCirclePoints(lat1, lng1, lat2, lng2, segments, upTo) {
        const toRad = Math.PI / 180;
        const p1 = {
            x: Math.cos(lat1 * toRad) * Math.cos(lng1 * toRad),
            y: Math.sin(lat1 * toRad),
            z: Math.cos(lat1 * toRad) * Math.sin(lng1 * toRad)
        };
        const p2 = {
            x: Math.cos(lat2 * toRad) * Math.cos(lng2 * toRad),
            y: Math.sin(lat2 * toRad),
            z: Math.cos(lat2 * toRad) * Math.sin(lng2 * toRad)
        };

        const dot = p1.x * p2.x + p1.y * p2.y + p1.z * p2.z;
        const angle = Math.acos(Math.max(-1, Math.min(1, dot)));

        const points = [];
        const count = Math.ceil(segments * upTo);
        for (let i = 0; i <= count; i++) {
            const t = i / segments;
            const sinAngle = Math.sin(angle);
            if (sinAngle < 0.001) {
                points.push(project(lat1, lng1));
                continue;
            }
            const a = Math.sin((1 - t) * angle) / sinAngle;
            const b = Math.sin(t * angle) / sinAngle;

            const x = a * p1.x + b * p2.x;
            const y = a * p1.y + b * p2.y;
            const z = a * p1.z + b * p2.z;

            // Elevate arc above globe surface
            const len = Math.sqrt(x * x + y * y + z * z);
            const midT = Math.sin(t * Math.PI);
            const elevation = 1 + midT * 0.15;

            const nx = (x / len) * elevation;
            const ny = (y / len) * elevation;
            const nz = (z / len) * elevation;

            const rotTheta = rotation * Math.PI / 180;
            const rx = nx * Math.cos(rotTheta) - nz * Math.sin(rotTheta);
            const rz = nx * Math.sin(rotTheta) + nz * Math.cos(rotTheta);

            points.push({
                x: centerX + rx * globeRadius,
                y: centerY - ny * globeRadius,
                z: rz
            });
        }
        return points;
    }

    function spawnArc() {
        const dest = destinations[Math.floor(Math.random() * destinations.length)];
        arcs.push({
            dest,
            progress: 0,
            speed: 0.008 + Math.random() * 0.006,
            opacity: 1,
            phase: 'grow',
            holdTime: 0
        });
    }

    function resize() {
        width = canvas.clientWidth;
        height = canvas.clientHeight;
        canvas.width = width * window.devicePixelRatio;
        canvas.height = height * window.devicePixelRatio;
        ctx.setTransform(window.devicePixelRatio, 0, 0, window.devicePixelRatio, 0, 0);
        globeRadius = Math.min(width, height) * 0.34;
        centerX = width / 2;
        centerY = height * 0.52;
    }

    function draw() {
        ctx.clearRect(0, 0, width, height);

        rotation += 0.03;
        arcTimer++;

        if (arcTimer % 50 === 0 && arcs.length < maxArcs) {
            spawnArc();
        }

        // === Draw globe wireframe ===
        // Outline circle
        ctx.beginPath();
        ctx.arc(centerX, centerY, globeRadius, 0, Math.PI * 2);
        ctx.strokeStyle = 'rgba(255, 255, 255, 0.10)';
        ctx.lineWidth = 1;
        ctx.stroke();

        // Latitude lines
        for (let lat = -60; lat <= 60; lat += 30) {
            ctx.beginPath();
            let started = false;
            for (let lng = -180; lng <= 180; lng += 3) {
                const p = project(lat, lng);
                if (p.z > 0) {
                    if (!started) { ctx.moveTo(p.x, p.y); started = true; }
                    else ctx.lineTo(p.x, p.y);
                } else {
                    started = false;
                }
            }
            ctx.strokeStyle = 'rgba(255, 255, 255, 0.06)';
            ctx.lineWidth = 0.5;
            ctx.stroke();
        }

        // Longitude lines
        for (let lng = -180; lng < 180; lng += 30) {
            ctx.beginPath();
            let started = false;
            for (let lat = -90; lat <= 90; lat += 3) {
                const p = project(lat, lng);
                if (p.z > 0) {
                    if (!started) { ctx.moveTo(p.x, p.y); started = true; }
                    else ctx.lineTo(p.x, p.y);
                } else {
                    started = false;
                }
            }
            ctx.strokeStyle = 'rgba(255, 255, 255, 0.06)';
            ctx.lineWidth = 0.5;
            ctx.stroke();
        }

        // === Draw destination dots (subtle, always visible if on front) ===
        for (const dest of destinations) {
            const p = project(dest.lat, dest.lng);
            if (p.z > 0) {
                ctx.beginPath();
                ctx.arc(p.x, p.y, 1.5, 0, Math.PI * 2);
                ctx.fillStyle = `rgba(200, 180, 140, ${0.15 + p.z * 0.1})`;
                ctx.fill();
            }
        }

        // === Draw origin dot (brighter) ===
        const originP = project(origin.lat, origin.lng);
        if (originP.z > 0) {
            // Outer glow
            const originGlow = ctx.createRadialGradient(originP.x, originP.y, 0, originP.x, originP.y, 12);
            originGlow.addColorStop(0, 'rgba(255, 255, 255, 0.3)');
            originGlow.addColorStop(1, 'rgba(255, 255, 255, 0)');
            ctx.fillStyle = originGlow;
            ctx.fillRect(originP.x - 12, originP.y - 12, 24, 24);

            // Core dot
            ctx.beginPath();
            ctx.arc(originP.x, originP.y, 3, 0, Math.PI * 2);
            ctx.fillStyle = 'rgba(255, 255, 255, 0.9)';
            ctx.fill();
        }

        // === Draw and update arcs ===
        for (let i = arcs.length - 1; i >= 0; i--) {
            const arc = arcs[i];

            if (arc.phase === 'grow') {
                arc.progress += arc.speed;
                if (arc.progress >= 1) {
                    arc.progress = 1;
                    arc.phase = 'hold';
                }
            } else if (arc.phase === 'hold') {
                arc.holdTime++;
                if (arc.holdTime > 60) {
                    arc.phase = 'fade';
                }
            } else if (arc.phase === 'fade') {
                arc.opacity -= 0.015;
                if (arc.opacity <= 0) {
                    arcs.splice(i, 1);
                    continue;
                }
            }

            const points = greatCirclePoints(
                origin.lat, origin.lng,
                arc.dest.lat, arc.dest.lng,
                60, arc.progress
            );

            // Draw arc trail
            const visiblePoints = points.filter(p => p.z > -0.1);
            if (visiblePoints.length > 1) {
                ctx.beginPath();
                ctx.moveTo(visiblePoints[0].x, visiblePoints[0].y);
                for (let j = 1; j < visiblePoints.length; j++) {
                    ctx.lineTo(visiblePoints[j].x, visiblePoints[j].y);
                }
                ctx.strokeStyle = `rgba(200, 180, 140, ${0.4 * arc.opacity})`;
                ctx.lineWidth = 1.5;
                ctx.stroke();

                // Glow on the leading edge
                if (arc.phase === 'grow' && visiblePoints.length > 0) {
                    const tip = visiblePoints[visiblePoints.length - 1];
                    if (tip.z > 0) {
                        const tipGlow = ctx.createRadialGradient(tip.x, tip.y, 0, tip.x, tip.y, 8);
                        tipGlow.addColorStop(0, `rgba(255, 220, 160, ${0.6 * arc.opacity})`);
                        tipGlow.addColorStop(1, 'rgba(255, 220, 160, 0)');
                        ctx.fillStyle = tipGlow;
                        ctx.fillRect(tip.x - 8, tip.y - 8, 16, 16);
                    }
                }

                // Pulse at destination when arc completes
                if (arc.phase === 'hold' || arc.phase === 'fade') {
                    const destP = project(arc.dest.lat, arc.dest.lng);
                    if (destP.z > 0) {
                        const pulseSize = 6 + (arc.phase === 'hold' ? Math.sin(arc.holdTime * 0.1) * 3 : 0);
                        const destGlow = ctx.createRadialGradient(destP.x, destP.y, 0, destP.x, destP.y, pulseSize);
                        destGlow.addColorStop(0, `rgba(255, 220, 160, ${0.5 * arc.opacity})`);
                        destGlow.addColorStop(1, 'rgba(255, 220, 160, 0)');
                        ctx.fillStyle = destGlow;
                        ctx.fillRect(destP.x - pulseSize, destP.y - pulseSize, pulseSize * 2, pulseSize * 2);

                        ctx.beginPath();
                        ctx.arc(destP.x, destP.y, 2, 0, Math.PI * 2);
                        ctx.fillStyle = `rgba(255, 230, 180, ${0.8 * arc.opacity})`;
                        ctx.fill();
                    }
                }
            }
        }

        // === Ambient glow behind globe ===
        const ambientGlow = ctx.createRadialGradient(centerX, centerY, globeRadius * 0.3, centerX, centerY, globeRadius * 1.3);
        ambientGlow.addColorStop(0, 'rgba(180, 150, 100, 0.05)');
        ambientGlow.addColorStop(1, 'rgba(0, 0, 0, 0)');
        ctx.globalCompositeOperation = 'destination-over';
        ctx.fillStyle = ambientGlow;
        ctx.fillRect(0, 0, width, height);
        ctx.globalCompositeOperation = 'source-over';

        animationId = requestAnimationFrame(draw);
    }

    resize();

    // Seed a few initial arcs so it's not empty on load
    for (let i = 0; i < 3; i++) {
        const arc = {
            dest: destinations[Math.floor(Math.random() * destinations.length)],
            progress: Math.random() * 0.7 + 0.3,
            speed: 0.008 + Math.random() * 0.006,
            opacity: 1,
            phase: 'grow',
            holdTime: 0
        };
        arcs.push(arc);
    }

    draw();

    const onResize = () => resize();
    window.addEventListener('resize', onResize);

    // Return cleanup function
    return function cleanup() {
        cancelAnimationFrame(animationId);
        window.removeEventListener('resize', onResize);
    };
}
