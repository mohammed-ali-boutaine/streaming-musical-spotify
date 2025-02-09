<!DOCTYPE html>
<html>
<head>
  <style>
    body {
      margin: 0;
      padding: 0;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      background-color: #121212;
      color: #ffffff;
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
    }

    .container {
      text-align: center;
      padding: 2rem;
      max-width: 600px;
    }

    .error-code {
      font-size: 8rem;
      font-weight: 700;
      margin: 0;
      background: linear-gradient(45deg, #1DB954, #1ed760);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      animation: pulse 2s infinite;
    }

    .message {
      font-size: 1.5rem;
      margin: 1rem 0 2rem;
      color: #b3b3b3;
    }

    .home-button {
      background-color: #1DB954;
      color: #000000;
      padding: 1rem 2rem;
      border-radius: 2rem;
      text-decoration: none;
      font-weight: 600;
      transition: transform 0.2s, background-color 0.2s;
      border: none;
      cursor: pointer;
    }

    .home-button:hover {
      background-color: #1ed760;
      transform: scale(1.05);
    }

    @keyframes pulse {
      0% { opacity: 1; }
      50% { opacity: 0.7; }
      100% { opacity: 1; }
    }

    .record {
      width: 180px;
      height: 180px;
      background: #333;
      border-radius: 50%;
      margin: 2rem auto;
      position: relative;
      animation: spin 4s linear infinite;
      box-shadow: 0 0 20px rgba(0,0,0,0.5);
    }

    .record::after {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      width: 30px;
      height: 30px;
      background: #121212;
      border-radius: 50%;
      transform: translate(-50%, -50%);
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="record"></div>
    <h1 class="error-code">404</h1>
    <p class="message">Looks like this track is missing from our playlist</p>
    <button class="home-button" onclick="window.location.href='/'">
      Back to Home
    </button>
  </div>
</body>
</html>