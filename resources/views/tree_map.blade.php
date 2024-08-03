<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tree Map de Refrigerantes</title>
    <script src="https://d3js.org/d3.v6.min.js"></script>
    <style>
        .node {
            border: 1px solid #fff;
            box-sizing: border-box;
            overflow: hidden;
            position: relative;
        }

        .node:hover {
            opacity: 0.7;
        }

        .label {
            position: absolute;
            color: white;
            padding: 5px;
            font-size: 10px;
        }

        .tooltip {
            position: absolute;
            text-align: center;
            padding: 10px;
            background: white;
            border: 1px solid #ccc;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.2s ease;
        }
    </style>
</head>
<body>
    <h1>Tree Map de Refrigerantes</h1>
    <div id="treeMap" style="width: 100%; height: 500px;"></div>
    <div id="tooltip" class="tooltip"></div>

    <script>
        const data = {!! $data !!};

        const width = document.getElementById('treeMap').offsetWidth;
        const height = document.getElementById('treeMap').offsetHeight;

        const root = d3.hierarchy(data[0]).sum(d => d.size);

        d3.treemap()
            .size([width, height])
            .padding(1)(root);

        const svg = d3.select("#treeMap").append("svg")
            .attr("width", width)
            .attr("height", height);

        const tooltip = d3.select("#tooltip");

        const nodes = svg.selectAll(".node")
            .data(root.leaves())
            .enter().append("g")
            .attr("class", "node")
            .attr("transform", d => `translate(${d.x0},${d.y0})`)
            .on("click", function(event, d) {
                tooltip
                    .style("left", (event.pageX + 5) + "px")
                    .style("top", (event.pageY - 28) + "px")
                    .style("opacity", 1)
                    .html(
                        `<strong>${d.data.name}</strong><br>
                         Vendas: ${d.data.size}<br>
                         Vendas Anteriores: ${d.data.previous_sales}<br>
                         Porcentagem de Crescimento: ${d.data.growth_percentage.toFixed(2)}%`
                    );
            });

        nodes.append("rect")
            .attr("id", d => d.data.name)
            .attr("width", d => d.x1 - d.x0)
            .attr("height", d => d.y1 - d.y0)
            .style("fill", d => d.data.color);

        nodes.append("text")
            .attr("class", "label")
            .attr("x", 5)
            .attr("y", 20)
            .text(d => d.data.name);

        nodes.on("mouseleave", function() {
            tooltip.style("opacity", 0);
        });
    </script>
</body>
</html>
