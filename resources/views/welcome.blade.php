<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body, html, #canvas {
            margin: 0;
            padding: 0;
            overflow: hidden;
            width: 100%;
            height: 100%;
            background: black;
            position: relative;
        }

        h1 {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -100%);
            color: white;
            font-family: 'Courier New', monospace, serif;
            text-align: center;
            font-size: 11vw;
            user-select: none;
        }

        h1 a {
            color: #fff;
            text-decoration: none;
            cursor: default;
        }
    </style>
    <title>Hyperdriven</title>
</head>
<body>
<canvas id="canvas"></canvas>
<h1>Hyper<a href="/test">d</a>riven</h1>
<script>
    // Configuration
    const nodeCount = 80;
    const nodeRadius = 1;
    const nodeMinSpeed = .1; // minimum node speed
    const nodeMaxSpeed = 1; // maximum node speed
    const maxConnections = 4; // maximum number of connections per node
    const lineDistance = 300; // distance between nodes to draw a line
    const lineColorBase = 70;
    const mouseEffectRadius = 100; // radius of the mouse effect
    const mouseEffectSpeedFactor = 1; // factor by which the speed is increased
    const mouseEffectSizeFactor = 1; // factor by which the size is increased

    // Create canvas
    const canvas = document.getElementById('canvas');
    const ctx = canvas.getContext('2d');

    // Resize canvas to full screen
    function resizeCanvas() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    }
    window.addEventListener('resize', resizeCanvas, false);
    resizeCanvas();

    // Create nodes
    const nodes = [];

    function createNode(x, y) {
        const speed = nodeMinSpeed + Math.random() * (nodeMaxSpeed - nodeMinSpeed);
        nodes.push({
            x, y,
            dx: (Math.random() - 0.5) * speed,
            dy: (Math.random() - 0.5) * speed
        });
    }

    for (let i = 0; i < nodeCount; i++) {
        createNode(Math.random() * canvas.width, Math.random() * canvas.height);
    }

    // Mouse position
    const mousePosition = {x: 0, y: 0};
    canvas.addEventListener('mousemove', function(event) {
        mousePosition.x = event.clientX;
        mousePosition.y = event.clientY;
    });

    // Add node on click
    canvas.addEventListener('click', () => createNode(mousePosition.x, mousePosition.y));

    // Animate
    function animate() {
        let dist;
        let dy;
        let dx;
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        // Draw lines between nodes and move them
        for (let i = 0; i < nodes.length; i++) { // change nodeCount to nodes.length
            const node = nodes[i];

            if (node.x < 0 || node.x > canvas.width) node.dx = -node.dx;
            if (node.y < 0 || node.y > canvas.height) node.dy = -node.dy;

            let numConnections = 0;
            for (let j = i + 1; j < nodes.length; j++) { // change nodeCount to nodes.length
                const node2 = nodes[j];

                dx = node.x - node2.x;
                dy = node.y - node2.y;
                dist = Math.sqrt(dx * dx + dy * dy);

                if (dist < lineDistance) {
                    const color = Math.floor(lineColorBase + (lineDistance - dist) / lineDistance * (255 - lineColorBase));
                    ctx.beginPath();
                    ctx.moveTo(node.x, node.y);
                    ctx.lineTo(node2.x, node2.y);
                    ctx.strokeStyle = 'rgb(' + color + ',' + color + ',' + color + ')';
                    ctx.stroke();
                    numConnections++;
                }

                if (numConnections >= maxConnections) break;
            }

            // Mouse effect
            let dModifier;
            let radiusModifier;
            dx = node.x - mousePosition.x;
            dy = node.y - mousePosition.y;
            dist = Math.sqrt(dx * dx + dy * dy);
            if (dist < mouseEffectRadius) {
                dModifier = mouseEffectSpeedFactor;
                radiusModifier = mouseEffectSizeFactor;
            } else {
                dModifier = 1;
                radiusModifier = 1;
            }

            ctx.beginPath();
            ctx.arc(node.x, node.y, nodeRadius * radiusModifier, 0, Math.PI * 2);
            ctx.fillStyle = 'white';
            ctx.fill();

            node.x += (node.dx * dModifier);
            node.y += (node.dy * dModifier);
        }

        requestAnimationFrame(animate);
    }

    animate();
</script>
</body>
</html>
