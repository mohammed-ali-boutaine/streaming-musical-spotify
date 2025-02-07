CREATE DATABASE spotifydb;
\c spotifydb;

/*

users
saved_playList (id , name,user_id,playList)
Playlist(id,user_id,chanson)
songs(id,title,artist)
caterogy(id,name,admin_id)
favorite_songs()
*/

-- Users Table
CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password TEXT NOT NULL,
    role VARCHAR(10) CHECK (role IN ('user', 'admin', 'artist')) DEFAULT 'user',
    status BOOLEAN DEFAULT TRUE,
    bio TEXT,
    image_path TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Indexes for Users Table
CREATE INDEX idx_users_email ON users(email);

-- Categories Table
CREATE TABLE categories (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) UNIQUE NOT NULL,
    description TEXT
);

-- Indexes for Categories Table
CREATE INDEX idx_categories_name ON categories(name);

-- Songs Table
CREATE TABLE songs (
    id SERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    artist_id INT NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    category_id INT REFERENCES categories(id) ON DELETE SET NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Indexes for Songs Table
CREATE INDEX idx_songs_title ON songs(title);
CREATE INDEX idx_songs_artist_id ON songs(artist_id);
CREATE INDEX idx_songs_category_id ON songs(category_id);

-- Playlists Table (User-created playlists)
CREATE TABLE playlists (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    image TEXT,
    user_id INT NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Indexes for Playlists Table
CREATE INDEX idx_playlists_name ON playlists(name);
CREATE INDEX idx_playlists_user_id ON playlists(user_id);

-- Playlist Songs Table (Many-to-Many Relationship)
CREATE TABLE playlist_songs (
    id SERIAL PRIMARY KEY,
    playlist_id INT NOT NULL REFERENCES playlists(id) ON DELETE CASCADE,
    song_id INT NOT NULL REFERENCES songs(id) ON DELETE CASCADE,
    UNIQUE (playlist_id, song_id) -- Avoid duplicate song entries in a playlist
);

-- Indexes for Playlist Songs Table
CREATE INDEX idx_playlist_songs_playlist_id ON playlist_songs(playlist_id);
CREATE INDEX idx_playlist_songs_song_id ON playlist_songs(song_id);


CREATE TABLE saved_playlists (
    id SERIAL PRIMARY KEY,
    user_id INT NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    playlist_id INT NOT NULL REFERENCES playlists(id) ON DELETE CASCADE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE (user_id, playlist_id) -- Prevent duplicate saves
);

-- Indexes for Saved Playlists Table
CREATE INDEX idx_saved_playlists_user_id ON saved_playlists(user_id);
CREATE INDEX idx_saved_playlists_playlist_id ON saved_playlists(playlist_id);


-- Favorite Songs Table (User's favorite songs)
CREATE TABLE favorite_songs (
    id SERIAL PRIMARY KEY,
    user_id INT NOT NULL REFERENCES users(id) ON DELETE CASCADE,
    song_id INT NOT NULL REFERENCES songs(id) ON DELETE CASCADE,
    UNIQUE (user_id, song_id) -- Avoid duplicate favorites
);

-- Indexes for Favorite Songs Table
CREATE INDEX idx_favorite_songs_user_id ON favorite_songs(user_id);
CREATE INDEX idx_favorite_songs_song_id ON favorite_songs(song_id);

CREATE OR REPLACE FUNCTION update_timestamp()
RETURNS TRIGGER AS $$
BEGIN
    NEW.updated_at = NOW();
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER update_users_timestamp
BEFORE UPDATE ON users
FOR EACH ROW
EXECUTE FUNCTION update_timestamp();