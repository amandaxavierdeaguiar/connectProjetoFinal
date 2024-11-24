<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game de Pontuação</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; }
        #scoreboard { margin-top: 20px; }
        button { padding: 10px 20px; font-size: 18px; cursor: pointer; }
    </style>
</head>
<body>
    <h1>Game de Pontuação</h1>
    <p id="player-name-container">
        Nome do jogador: <input type="text" id="player-name" placeholder="Digite seu nome">
        <button onclick="startGame()">Iniciar</button>
    </p>
    <div id="game-container" style="display: none;">
        <h2>Pontuação: <span id="score">0</span></h2>
        <button onclick="increaseScore()">Ganhar Pontos</button>
    </div>
    <div id="scoreboard">
        <h2>Ranking</h2>
        <ul id="ranking"></ul>
    </div>

    <script>
        let score = 0;
        let playerName = "";

        function startGame() {
            playerName = document.getElementById("player-name").value;
            if (!playerName) {
                alert("Por favor, insira seu nome!");
                return;
            }
            document.getElementById("player-name-container").style.display = "none";
            document.getElementById("game-container").style.display = "block";
            fetchRanking();
        }

        function increaseScore() {
            score++;
            document.getElementById("score").innerText = score;
            saveScore();
        }

        function saveScore() {
            fetch('/api/scores', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ player_name: playerName, score: score })
            })
            .then(response => response.json())
            .then(data => console.log('Pontuação salva:', data));
        }

        function fetchRanking() {
            fetch('/api/scores')
                .then(response => response.json())
                .then(data => {
                    const ranking = document.getElementById("ranking");
                    ranking.innerHTML = "";
                    data.forEach(player => {
                        const li = document.createElement("li");
                        li.innerText = `${player.player_name}: ${player.score}`;
                        ranking.appendChild(li);
                    });
                });
        }

        // Atualiza o ranking a cada 5 segundos
        setInterval(fetchRanking, 5000);
    </script>
</body>
</html>
