<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotify Clone</title>
    <link rel="stylesheet" href="/css/style.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <style>
        a{
            text-decoration: none;
            color: white;
        }
    </style>

</head>

<body>
    <div class="container">
        <!-- Top Navigation -->
        <div class="top-nav">
            <div class="nav-buttons">
                <button class="nav-button"><i class="fas fa-chevron-left"></i></button>
                <button class="nav-button"><i class="fas fa-chevron-right"></i></button>
            </div>
            <div class="nav-buttons">
                <button class="nav-button secondary">
                    <a href="/login">
                        Log in

                    </a>
                </button>
                <button class="nav-button primary">
                    <a href="/register">
                        Sign up

                    </a>
                </button>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">Spotify</div>
            <div class="nav-item">
                <i class="fas fa-home"></i>
                Home
            </div>
            <div class="nav-item">
                <i class="fas fa-search"></i>
                Search
            </div>
            <div class="nav-item">
                <i class="fas fa-book"></i>
                Your Library
            </div>

            <div class="playlist-section">
                <button class="add-playlist">
                    <i class="fas fa-plus"></i>
                    Create Playlist
                </button>
                <div class="nav-item">
                    <i class="fas fa-heart"></i>
                    Liked Songs
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <h1>Good evening</h1>
            <div class="playlist-grid">
                <div class="playlist-card">
                    <div class="playlist-img"></div>
                    <div class="playlist-title">Liked Songs</div>
                    <div class="playlist-description">324 songs</div>
                </div>
                <div class="playlist-card">
                    <div class="playlist-img"></div>
                    <div class="playlist-title">Daily Mix 1</div>
                    <div class="playlist-description">Made for you</div>
                </div>
                <div class="playlist-card">
                    <div class="playlist-img"></div>
                    <div class="playlist-title">Discover Weekly</div>
                    <div class="playlist-description">Updated every Monday</div>
                </div>
            </div>

            <!-- Music List -->
            <div class="music-list">
                <h2>Popular Tracks</h2>
                <div class="music-list-header">
                    <div>#</div>
                    <div>TITLE</div>
                    <div>ARTIST</div>
                    <div>DURATION</div>
                </div>
                <div class="song-item">
                    <div class="song-number">1</div>
                    <div class="track-name">Song Title 1</div>
                    <div class="artist-name">Artist 1</div>
                    <div>3:45</div>
                </div>
                <div class="song-item">
                    <div class="song-number">2</div>
                    <div class="track-name">Song Title 2</div>
                    <div class="artist-name">Artist 2</div>
                    <div>4:20</div>
                </div>
                <div class="song-item">
                    <div class="song-number">3</div>
                    <div class="track-name">Song Title 3</div>
                    <div class="artist-name">Artist 3</div>
                    <div>3:30</div>
                </div>
            </div>
        </div>

        <!-- Player -->
        <div class="player">
            <div class="now-playing">
                <div class="playlist-img" style="width: 56px;"></div>
                <div class="track-info">
                    <div class="track-name">Track Name</div>
                    <div class="artist-name">Artist Name</div>
                </div>
            </div>

            <div class="player-controls">
                <button class="control-button">
                    <i class="fas fa-random"></i>
                </button>
                <button class="control-button">
                    <i class="fas fa-step-backward"></i>
                </button>
                <button class="control-button play-button" id="play-button">
                    <i class="fas fa-play"></i>
                </button>
                <button class="control-button">
                    <i class="fas fa-step-forward"></i>
                </button>
                <button class="control-button">
                    <i class="fas fa-redo"></i>
                </button>
                <div class="progress-bar">
                    <div class="progress"></div>
                </div>
            </div>

            <div class="volume-controls">
                <i class="fas fa-volume-up"></i>
                <div class="progress-bar" style="width: 100px;">
                    <div class="progress"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle play/pause
        const playButton = document.querySelector('.play-button');
        let isPlaying = false;

        playButton.addEventListener('click', () => {
            isPlaying = !isPlaying;
            playButton.innerHTML = isPlaying ?
                '<i class="fas fa-pause"></i>' :
                '<i class="fas fa-play"></i>';
        });

        // Make progress bars interactive
        const progressBars = document.querySelectorAll('.progress-bar');

        progressBars.forEach(bar => {
            bar.addEventListener('click', (e) => {
                const rect = bar.getBoundingClientRect();
                const percent = (e.clientX - rect.left) / rect.width;
                bar.querySelector('.progress').style.width = `${percent * 100}%`;
            });
        });

        // Make playlist cards and song items interactive
        const playlistCards = document.querySelectorAll('.playlist-card');
        const songItems = document.querySelectorAll('.song-item');

        playlistCards.forEach(card => {
            card.addEventListener('click', () => {
                console.log('Loading playlist:', card.querySelector('.playlist-title').textContent);
            });
        });

        songItems.forEach(song => {
            song.addEventListener('click', () => {
                const title = song.querySelector('.track-name').textContent;
                const artist = song.querySelector('.artist-name').textContent;
                console.log('Playing:', title, 'by', artist);
            });
        });

        // Create Playlist button
        document.querySelector('.add-playlist').addEventListener('click', () => {
            console.log('Creating new playlist');
            // Add your playlist creation logic here
        });

        // Login and Signup buttons
        document.querySelectorAll('.nav-button').forEach(button => {
            button.addEventListener('click', () => {
                if (button.textContent === 'Log in') {
                    console.log('Opening login form');
                } else if (button.textContent === 'Sign up') {
                    console.log('Opening signup form');
                }
            });
        });
    </script>
</body>

</html>