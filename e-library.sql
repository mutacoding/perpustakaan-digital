-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2023 at 02:23 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-library`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_buku`
--

CREATE TABLE `tb_buku` (
  `id_buku` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `penulis` varchar(100) NOT NULL,
  `penerbit` varchar(100) NOT NULL,
  `tahun_terbit` date NOT NULL,
  `deskripsi` varchar(10000) NOT NULL,
  `cover_buku` varchar(250) NOT NULL,
  `file_buku` varchar(250) NOT NULL,
  `view` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_buku`
--

INSERT INTO `tb_buku` (`id_buku`, `judul`, `kategori_id`, `penulis`, `penerbit`, `tahun_terbit`, `deskripsi`, `cover_buku`, `file_buku`, `view`) VALUES
(3, 'Perahu Kertas', 11, 'Dewi Lestari', 'Bentang Pustaka dan Truedee Pustaka Sejati', '2009-08-01', 'Novel Perahu Kertas bertemakan persahabatan, percintaan, dan idealisme seseorang. Kisah ini berawal dengan seorang remaja laki-laki yang baru saja lulus dari Sekolah Menengah Akhir (SMA) bernama Keenan. Ia adalah laki-laki yang cerdas, mempunyai minat dan bakat dalam bidang seni melukis sangat kuat.\r\n\r\nKeenan hanya bercita-cita menjadi seorang penulis, tidak ada cita-cita lain baginya. Akan tetapi, kesepakatan antara Keenan dengan sang ayah yang mengharuskan dirinya pergi meninggal Amsterdam untuk kuliah di Indonesia, tepatnya di Fakultas Ekonomi, Bandung.\r\n\r\nTokoh utama lain dalam novel ini ialah Kugy. Kugy merupakan perempuan unik, mempunyai daya imaji yang sangat tinggi, kemudian bisa dibilang ia berpenampilan eksentrik cenderung berantakan. Kugy hendak berkuliah di kampus yang sama dengan Keenan, di Bandung.\r\n\r\nSedari kecil, Kugy memang sudah mencintai dunia perdongengan. Maka dari itu, jangan heran bila dirinya mempunyai imajinasi tinggi. Ia memiliki koleksi dan taman bacaan, serta hobi menulis cerita dongeng. Tidak lain, ia hanya bercita-cita untuk menjadi juru dongeng.\r\n\r\nAkan tetapi, dirinya menyadari bahwa penulis atau juru dongeng bukanlah suatu profesi atau pekerjaan yang ‘menghasilkan’ dan diterima oleh lingkungan kehidupannya. Kugy memiliki cara agar dirinya tidak jauh-jauh dari dunia kepenulisan, yakni dengan melanjutkan studinya di Fakultas Sastra.\r\n\r\nPertemuan antara Keenan dan Kugy berawal dari Eko dan Noni yang mana Eko merupakan sepupu dari Keenan, sedangkan Noni merupakan sahabat baik Kugy sedari kecil. Mereka semua, kecuali Noni, berpindah dari Jakarta dan kuliah di kampus yang sama di kota Bandung. Keenan, Kugi, Eko, dan Noni akhirnya menjadi sahabat baik.\r\n\r\nHingga akhirnya, Kugy dan Keenan memiliki rasa kagum antara satu sama lain dan mulai mengalami adanya perubahan. Dengan kata lain, tanpa memiliki kesempatan untuk bersuara, mereka sudah meletakkan hatinya masing-masing. Akan tetapi, keadaan saat itu memang tidak memungkinkan untuk mereka saling berbagi rasa.\r\n\r\nKugy sudah memiliki kekasih, bernama Joshua atau Kugy memanggilnya Ojos. Keenan yang saat itu belum memiliki kekasih, kemudian dicomblangkan oleh Eko dan Noni bernama Wanda, yakni seorang kurator muda dan bisa dikatakan bernasib sama dengan Keenan.\r\n\r\nHal itu terlihat bahwa Keenan dan Wanda memiliki minat dan bakat dalam bidang yang sama, yaitu melukis dan ingin menjadi seorang pelukis juga. Akan tetapi, orang tua dari mereka berdua tidak mengizinkan sebab para orang tuanya menganggap bahwa hanya dengan lukisan tidak dapat menghasilkan uang untuk kebutuhan hidup. Keenan dan Wanda memiliki hubungan yang semakin erat karena keduanya merasa jika mereka bernasib sama.\r\n\r\nSebenarnya, ketika Kugy mengetahui kedekatan antara Kugy dan Wanda, dirinya seakan cemburu, tetapi ia terlihat seolah tidak peduli, bahkan menyangkal rasa cemburu itu. Hingga akhirnya Wanda dan Keenan menjadi sepasang kekasih sebab dan Wanda juga rela untuk bertindak apa saja untuk menunjukkan rasa cintanya kepada Keenan.\r\n\r\nSetelah mendengar Keenan dan Wanda berpacaran, Kugy merasakan amat sakit di dadanya seakan ditusuk tombak runcing. Ia tidak tahu apa yang dirasakan oleh perasaannya saat itu, bisa dibilang perasaannya absurd.\r\n\r\nPada satu sisi, dirinya sadar bahwa ia mempunyai Ojos sebagai kekasihnya. Akan tetapi, di sisi lain, dirinya ada perasaan yang berbeda pada Keenan, perasaan yang seolah memandang Keenan sebagai sosok yang spesial di mata Kugy. Ojos jadi merasakan adanya perbedaan dalam diri Kugy, yakni sikap ketidakpedulian. Sayangnya, hubungan mereka berdua terpaksa kandas.\r\n\r\nPersahabatan mereka berempat, yakni Keenan, Kugy, Eko, dan Noni sedikit merenggang. Kugy memutuskan untuk mencari kesibukan baru, yaitu menjadi seorang guru relawan bernama Sakola Alit, semacam sekolah darurat.\r\n\r\nDi Sakola Alit, Kugy bersua dengan murid yang sangat bandel bernama Pilik. Pilik beserta teman-teman lainnya berhasil ia taklukkan hatinya dengan menuliskan sebuah cerita dongeng terkait kisah petualangan mereka, berjudul “Jenderal Pilik dan Pasukan Alit”. Kugy menulis cerita hampir setiap hari tentang para muridnya. Cerita itu ia tulis di dalam sebuah buku yang nantinya akan diberikan pada Keenan.\r\n\r\nKemudian, awalnya hubungan antara Keenan dan Wanda berjalan baik-baik saja, tetapi lambat laun mulai berbeda dan berubah. Wanda selalu berpikir bahwa Keenan tidak sepenuh hati mencintainya, kemudian mereka dihadapkan dengan konflik yang terbilang besar, hingga akhirnya hubungan mereka kandas jua. Saat hubungan Keenan sudah berakhir dengan Wanda, berakhir pulalah impian yang selama ini ia susun hanya dalam semalam.\r\n\r\nDengan perasaan yang berantakan, Keenan terpaksa pergi meninggalkan kehidupannya di Bandung dan pergi ke Ubud, Bali. Di sana, ia menetap di rumah sahabat ibunya, yaitu Pak Wayan. Keluarga Pak Wayan adalah para seniman terkenal di Bali sehingga saat Keenan tinggal bersama mereka, ia merasakan adanya kenyamanan dan perasaannya yang luka itu lambat laun terobati.\r\n\r\nAdapun orang yang dikatakan sangat berpengaruh dalam proses penyembuhan batin Keenan, yakni Luhde Laksmi yang merupakan keponakan dari Pak Wayan. Keenan perlahan dapat kembali melukis dengan modal kisah dalam buku “Jenderal Pilik dan Pasukan Alit” yang diberikan oleh Kugy. Keenan berhasil menciptakan sebuah karya lukisan berseri yang amat terkenal, bahkan menjadi buruan para kolektor lukisan.\r\n\r\nDi balik itu, ada sosok Kugy yang sangat kehilangan para sahabatnya, ia merasa sepi berada di Bandung dan mencoba untuk menata kembali hidupnya.\r\n\r\nKugy telah lulus kuliah secara cepat dan tak lama dari itu, ia bekerja sebagai copywriter pada sebuah biro iklan di Jakarta. Di tempat Kugy bekerja, ia bertemu dengan seseorang bernama Remigius atau Remi. Remi merupakan sahabat dari Karel–abangnya Kugy–sekaligus atasannya Kugy.\r\n\r\nKugy memiliki pemikiran yang unik, ajaib, dan selalu spontan sehingga menjadikan dirinya sebagai orang yang bisa dibilang cukup diandalkan di kantornya. Akan tetapi, berbeda dengan Remi, ia melihat sosok Kugy dengan pandangan yang berbeda. Remi menyukai Kugy bukan sekadar akan ide-ide cemerlangnya, melainkan pula semangat dan taraf keunikan yang ada dalam diri Kugy.\r\n\r\nBagi Remi, Kugy bukanlah wanita biasa, tetapi luar biasa. Kemudian, Remi memutuskan untuk menyatakan perasaannya pada Kugy, hingga akhirnya ketulusan darinya berhasil meluluhkan Kugy.\r\n\r\nDi samping itu, Keenan tidak bisa untuk terus menerus tinggal di Bali dengan kondisi kesehatan sang ayah yang semakin memburuk. Tidak ada pilihan lain, ia terpaksa pulang ke Jakarta dan memimpin perusahaan keluarganya. Keenan dan Luhde, sementara Kugy dengan Remi. Mereka semua merasa bahwa telah bertemu dengan orang yang tepat dan cinta yang sesungguhnya.\r\n\r\nAkan tetapi, hal itu tidaklah lama. Remi merasa bahwa Kugy hanya setengah hati padanya, demikian pula dengan Luhde. Hingga akhirnya, lukisan milik Keenan dan dongeng milik Kugy bertemu dengan impian dan hati yang seiringan bersatu.\r\n\r\nPertemuan Keenan dan Kugy tidak terhindarkan, terlebih keempat sahabat ini bertemu kembali dengan kondisi yang sudah berubah dan berbeda. Hati mereka kembali diuji, kisah percintaan dan persahabatan selama lima tahun ini kandas secara tidak terduga. Setiap hati dari mereka hanya dapat pasrah akan cinta yang mengalir dan bermuara entah ke mana.\r\n\r\nLantas, Akankah mereka terus-menerus pasrah dengan keadaan? Ikuti kelanjutan kisah persahabatan dan percintaan antara Keenan, Kugy, Eko, dan Noni, tentunya di novel Perahu Kertas karya Dewi “Dee” Lestari.', '1700914019_cd4614812fc9ad5a6feb.jpg', '1700914019_319d611788908a1adf4a.pdf', 0),
(4, 'Bumi Manusia (Cetakan Kesembilan)', 11, 'Pramoedya Ananta Toer', 'Lentera Dipantara', '2001-03-01', 'Bumi Manusia mengikuti kehidupan Minke, siswa HBS atau sekolah menengah atas dengan pengantar bahasa Belanda. Minke—yang merupakan satu-satunya orang Indonesia di antara siswa Belanda—mendapat kesempatan dari pemerintah kolonial untuk bersekolah di s', '1700915829_b178238af8d26a0c90b0.jpg', '1700915829_545edd7087e01f785177.pdf', 0),
(5, 'Cantik Itu Luka', 11, 'Eka Kurniawan', 'PT Gramedia Pustaka Utama', '2015-01-01', 'Kisah Cantik Itu Luka berlatar belakang pada masa penjajahan dan mengisahkan kehidupan kompleks tokoh utama Dewi Ayu, seorang perempuan cantik dan eksotis. Dewi Ayu adalah seorang pelacur dengan paras yang rupawan. Ia dibesarkan oleh kakek neneknya s', '1700916703_5f5454a65b0e2730e9f4.jpg', '1700916703_09e4d09f8de4c6c18487.pdf', 0),
(8, 'ss', 11, 'ss', 'ss', '2023-12-01', 'jss', '1701007709_a8715a207637f47aa1bb.jpg', '1701007709_6fa30b8cd1c40625226b.pdf', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_contact`
--

CREATE TABLE `tb_contact` (
  `id_contact` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pesan` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_contact`
--

INSERT INTO `tb_contact` (`id_contact`, `email`, `pesan`) VALUES
(1, 'nisa@gmail.com', 'haloo');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `kategori`) VALUES
(11, 'Fiksi'),
(12, 'Umum'),
(13, 'Filsafat dan Psikologi'),
(14, 'Agama'),
(15, 'Sosial'),
(16, 'Bahasa'),
(17, 'Sains dan Matematika'),
(18, 'Teknologi'),
(19, 'Seni dan Rekreasi'),
(20, 'Literatur dan Sastra'),
(21, 'Sejarah dan Geografi');

-- --------------------------------------------------------

--
-- Table structure for table `tb_prodi`
--

CREATE TABLE `tb_prodi` (
  `id_prodi` int(11) NOT NULL,
  `prodi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_prodi`
--

INSERT INTO `tb_prodi` (`id_prodi`, `prodi`) VALUES
(12, 'teknik'),
(13, 'teknik komputer'),
(14, 'akuntansi'),
(15, 'mi');

-- --------------------------------------------------------

--
-- Table structure for table `tb_role`
--

CREATE TABLE `tb_role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_role`
--

INSERT INTO `tb_role` (`id_role`, `role`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `no_induk` varchar(20) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(256) NOT NULL,
  `jenkel` char(1) NOT NULL DEFAULT 'N',
  `alamat` varchar(100) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `status` varchar(250) NOT NULL,
  `foto` varchar(256) NOT NULL DEFAULT 'default.jpg',
  `prodi` varchar(256) NOT NULL DEFAULT 'none',
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama`, `no_induk`, `email`, `password`, `jenkel`, `alamat`, `telp`, `status`, `foto`, `prodi`, `role_id`) VALUES
(1, 'admin', '', 'a@gmail.com', '123', '', '', '', '', 'default.jpg', 'none', 1),
(2, 'Takeru Satoh', '', 'satoh@gmail.com', '123', 'N', '', '', 'mahasiswa', 'default.jpg', '6', 2),
(3, 'nisa', '', 'nisa@gmail.com', 'nisa123', 'N', '', '', 'mahasiswa', 'default.jpg', 'Lumba lumba asli jawa', 2),
(4, 'nis', '', 's@gmail.com', '123', 'N', '', '', 'mahasiswa', 'default.jpg', 'teknik', 2),
(5, 'jeno', '', 'jeno@gmail.com', '1234', 'N', '', '', 'mahasiswa', 'default.jpg', 'teknik komputer', 2),
(6, 'nia', '', 'as@gmail.com', '1234', 'N', '', '', 'dosen', 'default.jpg', 'teknik komputer', 2),
(7, 'm', '', 'm@gmail.com', '1234', 'N', '', '', 'dosen', 'default.jpg', 'akuntansi', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_buku`
--
ALTER TABLE `tb_buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indexes for table `tb_contact`
--
ALTER TABLE `tb_contact`
  ADD PRIMARY KEY (`id_contact`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tb_prodi`
--
ALTER TABLE `tb_prodi`
  ADD PRIMARY KEY (`id_prodi`);

--
-- Indexes for table `tb_role`
--
ALTER TABLE `tb_role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `prodi_id` (`prodi`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_buku`
--
ALTER TABLE `tb_buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_contact`
--
ALTER TABLE `tb_contact`
  MODIFY `id_contact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tb_prodi`
--
ALTER TABLE `tb_prodi`
  MODIFY `id_prodi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_role`
--
ALTER TABLE `tb_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_buku`
--
ALTER TABLE `tb_buku`
  ADD CONSTRAINT `tb_buku_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `tb_kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD CONSTRAINT `tb_user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `tb_role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
