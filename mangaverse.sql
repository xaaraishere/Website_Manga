-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Feb 2025 pada 15.16
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mangaverse`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'tes', 'tes@gmail.com', 'Ingin manga boku no pico bang ~~tes Luiz', '2025-02-09 08:21:19'),
(2, 'Luiz Sahadan', 'tes2@gmail.com', 'Coba 2x bang webnya seadanya\r\n', '2025-02-09 08:22:19'),
(3, 'xaara', 'admin@gmail.com', 'naruto', '2025-02-09 08:25:10'),
(4, 'adam', 'adam@gmail.com', 'bang one pis dong', '2025-02-09 12:30:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `manga`
--

CREATE TABLE `manga` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `manga`
--

INSERT INTO `manga` (`id`, `title`, `image`, `price`, `description`) VALUES
(1, 'Alya Hides Her Feelings in Russian', 'images/mc1.png', 250000, 'Cerita ini berfokus pada Masachika Kuze, seorang siswa SMA yang agak malas tetapi jeli, dan teman sebangkunya yang cantik dan cerdas, Alisa Mikhailovna Kujo (Alya), seorang gadis berdarah campuran Rusia dan Jepang. Alya yang dikagumi karena sikapnya yang dingin dan angkuh, sering melontarkan komentar sarkastik atau sinis kepada Masachika. Namun, ia juga membisikkan perasaannya yang sebenarnya dalam bahasa Rusia, dengan asumsi bahwa Masachika tidak mengerti. Tanpa sepengetahuan Alya, Masachika diam-diam tahu bahasa Rusia, mengubah interaksi mereka menjadi campuran humor, romantis, dan momen-momen yang menyentuh hati.'),
(2, 'My Girlfriend Cheated on Me', 'images/mc2.png', 250000, 'Yuu Isshiki, seorang mahasiswa tahun pertama, mengetahui bahwa pacarnya Karen berselingkuh dengan seniornya, Kamokura. Dia sangat terkejut dan hancur sehingga dia bertanya kepada pacar Kamokura dan gadis paling cantik di kampus, Touko: “Tolong selingkuh dengan saya! ” Komedi romantis yang mendebarkan yang dimulai dengan hubungan kaki tangan!'),
(3, 'Hell\'s Paradise', 'images/mc3.png', 250000, 'Hell’s Paradise: Jigokuraku bercerita tentang seorang ninja dari Desa Iwagakure yang bernama Gabimaru. Dia adalah ninja terkuat yang dikenal sangat dingin dan tidak memiliki emosi. Suatu hari, dia dijebak oleh teman-teman ninjanya dan berakhir ditetapkan sebagai terpidana mati. Gabimaru yang lelah dengan pengkhianatan dan pembunuhan pun menerima hukuman tersebut. Tetapi, ketika dia bertemu dengan Sagiri Yamada Asaemon, Gabimaru menyadari jika dia masih ingin hidup agar kembali ke istrinya. Ninja terkuat itupun diberikan kesempatan untuk bisa bebas dan lepas dari hukuman matinya. Namun dengan syarat harus menemukan ramuan kehidupan bernama Elixir of Life. Ramuan tersebut hanya bisa didapatkan dari sebuah pulau yang legendaris yang dikenal dengan nama Sukhavati sebagai tanah suci Buddha. Perjuangan Gabimaru tidak akan mudah karena pulau tersebut cukup berbahaya. Lantas, apakah Gabimaru berhasil menemukan Elixir of Life agar bisa kembali bersama istrinya?'),
(4, 'Blue Lock', 'images/mc4.png', 250000, 'Blue Lock bercerita tentang perjalanan Asosiasi Sepak Bola Jepang (JFA) yang mencari sosok striker (penyerang) bola terbaik. Program pencarian ini dipimpin oleh seorang pelatih bernama Ego Jinpachi yang membentuk dan menyusun strategi pelatihan radikal di sebuah institusi penjara bernama Blue Lock. Blue Lock dibentuk sebagai tempat berlatih yang mengumpulkan 300 striker muda dengan cara memenjara mereka untuk memusatkan pelatihan keras. Bermain di Blue Lock memerlukan keegoisan untuk menjadi pemain nomor satu, yang mana membuat mereka bermain tanpa mengutamakan kerja sama tim, melainkan saling memanfaatkan kekuatan tiap pemain demi kemenangan pribadi.'),
(5, 'Blue Box', 'images/mc5.png', 250000, 'Berlatar di Akademi Eimei, sebuah sekolah yang memiliki keunggulan dalam menciptakan atlet-atlet berbakat. Taiki Inomata, anggota dari klub bulu tangkis selalu datang di pagi hari untuk berlatih sendirian. Namun, sayangnya ia selalu kalah cepat oleh Chinatsu Kano, anggota klub basket. Taiki yang sangat mengagumi Chinatsu pun bertekad untuk menjadi pemain terkenal agar bisa bersanding dengan gadis yang ia cintai tersebut. Untuk mencapai tujuannya tentu tidak mudah, terlebih hubungan mereka berdua mulai mengalami perubahan setelah keduanya tinggal bersama-sama.'),
(6, 'Frieren : Beyond Journey’s End', 'images/mc6.png', 250000, 'Setelah berhasil mengalahkan raja iblis, kelompok pahlawan yang terdiri dari dwarf, elf, manusia, dan pendeta kembali ke kota untuk memulai hidup yang baru. Frieren, seorang elf, telah berjanji ke rekannya untuk melihat hujan meteor yang lebih indah. Suatu hari, Frieren mendatangi rekannya yakni Himmel, manusia yang turut mengalahkan raja iblis. Frieren terkejut ketika melihat Himmel kini telah menjadi kakek tua. Setelah melihat hujan meteor, sang pahlawan manusia telah meninggal. Beberapa tahun berselang, rekan Frieren yakni sang pendeta juga turut menghembuskan napas terakhir. Menyadari bahwa elf memiliki umur panjang, Frieren mulai ingin membiasakan diri untuk tidak melibatkan perasaan masa lalunya saat menjadi bagian dari kelompok pahlawan. Mampukah ia melakukannya?'),
(7, 'Tying the Knot with an Amagami Sister ', 'images/mc7.png', 250000, 'Uryuu Kamihate, siswa kelas 2 SMA memiliki tujuan untuk masuk di Fakultas Kedokteran Universitas Kyoto. Sejak ibunya meninggal, Uryuu tinggal dan besar di panti asuhan. Namun, suatu hari ia dibawa oleh Kepala Pendeta Kuil Kanjin di Kyoto. Sesampainya di kuil tersebut, Uryuu justru bertemu dengan tiga gadis cantik. Di sana, Uryuu diberitahu bahwa ia akan menikahi salah satu gadis tersebut dan mewarisi kuil. Tentu, awalnya Uryuu merasa terkejut karena tujuan awalnya datang ke kuil tersebut hanya untuk menetap saja. Walau begitu, takdir yang mengikat Uryuu dan ketiga gadis tersebut perlahan mulai terhubung. Kini, siapakah gadis yang akan Uryuu nikahi?'),
(8, 'Re:ZERO -Starting Life in Another World ', 'images/mc8.png', 250000, 'Natsuki Subaru adalah seorang NEET biasa. Namun, kehidupannya berubah drastis setelah ia pulang dari berbelanja di sebuah minimarket. Anehnya, ia langsung saja terlempar ke dunia lain. Awalnya, Subaru merasa takjub dengan dunia paralel tersebut tanpa memikirkan apa yang akan terjadi. Di sana, ia bertemu dengan seorang gadis elf bernama Emilia. Subaru kemudian membantu Emilia mencari sebuah benda yang hilang. Sayangnya, mereka berdua terjebak dalam masalah besar dan harus menghadapi kematian. Namun, hal yang mengejutkan terjadi. Subaru tiba-tiba hidup kembali! Awalnya, ia tidak menyadari kekuatan unik yang dimilikinya. Setelah beberapa kali mengalami kematian dan kebangkitan, Subaru baru menyadari bahwa ia memiliki kemampuan \"Return by Death\". Kemampuan ini memungkinkannya untuk kembali ke titik waktu sebelum kematiannya. Setelah berhasil menyelamatkan Emilia, Subaru memutuskan untuk menjadi pelayannya dan tinggal di kediaman Emilia. Dari sinilah kisah petualangan Subaru dimulai. Akankah ia berhasil mengubah nasib orang-orang yang dicintainya?'),
(9, 'Rent-a-Girlfriend', 'images/mc9.png', 250000, 'Cerita berpusat pada Kazuya Kinoshita, seorang mahasiswa yang baru saja mengalami depresi karena diputuskan oleh pacarnya. Dalam kegalauan dan kesedihan, Kazuya melihat sebuah aplikasi penyewaan pacar yang dapat digunakan oleh siapapun. Mungkin saja pacar-pacar di sana dapat mengisi kehampaannya sementara. Dari aplikasi inilah Kazuya bertemu dengan Chizuru Ichinose, seorang gadis yang menjadi pacar pertama yang ia sewa. Setelah sehari bersama Chizuru, Kazuya merasa bahagia. Namun, akhirnya Kazuya menyadari bahwa semua itu hanyalah akting dari Chizuru agar terlihat profesional. Untuk kedua kalinya Kazuya menyewa Chizuru, untuk meluapkan perasaannya yang merasa terbohongi oleh Chizuru. Namun, di hari inilah Kazuya tak sengaja mempertemukan Chizuru dengan keluarganya. Kesalahpahaman dan kebohongan ini semakin membesar. Di perpisahan mereka, Kazuya menyadari dirinya hanyalah pengecut dan bertekad untuk tak menggunakan aplikasi itu lagi. Ia ingin mengandalkan jati dirinya untuk mencari belahan jiwanya. Namun, apakah ia akan bertindak demikian di lain waktu?'),
(10, 'The Eminence in Shadow', 'images/mc10.png', 250000, 'Sejak kecil, Minoru Kagenou berambisi untuk menjadi sekuat mungkin. Demi mewujudkan itu, ia menjalani berbagai pelatihan keras. Namun, ambisinya bukan untuk diakui oleh orang lain, melainkan untuk berbaur dengan lingkungan. Jadi, di siang hari ia berpura-pura menjadi siswa biasa, sementara di malam hari ia berkeliling dengan linggis untuk menghajar para geng motor lokal. Namun, ambisinya terhenti saat ia mengalami kecelakaan truk. Di ambang kematian, ia menyesali kelemahannya sebagai manusia. Tidak peduli seberapa keras ia berlatih, ia tidak bisa mengatasi keterbatasan fisiknya. Namun, alih-alih meninggal, Minoru terlahir kembali sebagai Cid, anak kedua dari keluarga bangsawan Kagenou, di dunia lain di mana sihir adalah hal biasa. Dengan kekuatan yang selama ini ia dambakan akhirnya berada dalam jangkauannya, ia menggunakan nama samaran \"Shadow\" dan mendirikan Shadow Garden: sebuah organisasi yang bertujuan untuk melawan Cult of Diablos, sebuah organisasi misterius yang terinspirasi dari imajinasinya. Namun, seiring pertumbuhan Shadow Garden, baik dalam jumlah anggota maupun pengaruhnya, menjadi semakin jelas bahwa Cult of Diablos bukanlah sekadar fiksi seperti yang Cid bayangkan.'),
(11, 'ONE PIECE', 'images/1739094196_fototesting.jpg', 696969, 'tes ONEPIECE'),
(12, 'OEN PISCE', 'images/1739094376_wanpis.jpg', 696911169, 'PIECE ONE');

-- --------------------------------------------------------

--
-- Struktur dari tabel `manga_pages`
--

CREATE TABLE `manga_pages` (
  `id` int(11) NOT NULL,
  `manga_id` int(11) DEFAULT NULL,
  `page_number` int(11) DEFAULT NULL,
  `pdf_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `manga_pages`
--

INSERT INTO `manga_pages` (`id`, `manga_id`, `page_number`, `pdf_url`) VALUES
(1, 1, 1, 'read/vol1.pdf'),
(6, 2, 1, 'read/1739109571_vol1.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `manga_id` int(11) NOT NULL,
  `tanggal_transaksi` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `nama`, `alamat`, `manga_id`, `tanggal_transaksi`) VALUES
(1, 'Luiz Sahadan', 'testo', 1, '2025-02-09 12:57:25'),
(2, 'tes', 'tes', 3, '2025-02-09 12:57:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(1, 'test@gmail.com', '$2y$10$pD.h5P0jYiA1GMBpyDDyFuaQgwxgLi7vc09hLuSer4XmlbTagA4tq'),
(2, '11@gmail.com', '$2y$10$Mf99kEciR423B59vNTo7RuE72iZItxmg5OC11mP3nzeXudKbYf.qm');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `manga`
--
ALTER TABLE `manga`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `manga_pages`
--
ALTER TABLE `manga_pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manga_id` (`manga_id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manga_id` (`manga_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `manga`
--
ALTER TABLE `manga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `manga_pages`
--
ALTER TABLE `manga_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `manga_pages`
--
ALTER TABLE `manga_pages`
  ADD CONSTRAINT `manga_pages_ibfk_1` FOREIGN KEY (`manga_id`) REFERENCES `manga` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`manga_id`) REFERENCES `manga` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
