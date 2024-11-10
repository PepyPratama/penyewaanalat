-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 26 Agu 2024 pada 13.21
-- Versi server: 8.0.37-cll-lve
-- Versi PHP: 8.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project6_mezzodb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_alat`
--

CREATE TABLE `tbl_alat` (
  `id_alat` int NOT NULL,
  `id_kategori_alat` int NOT NULL,
  `id_pembelian` int NOT NULL,
  `no_seri` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `harga_sewa` int NOT NULL,
  `stok_keseluruhan` int NOT NULL,
  `stok_rusak` int NOT NULL,
  `stok_tersedia` int NOT NULL,
  `stok_disewa` int NOT NULL,
  `spesifikasi` text COLLATE utf8mb4_general_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_alat`
--

INSERT INTO `tbl_alat` (`id_alat`, `id_kategori_alat`, `id_pembelian`, `no_seri`, `harga_sewa`, `stok_keseluruhan`, `stok_rusak`, `stok_tersedia`, `stok_disewa`, `spesifikasi`, `foto`) VALUES
(1, 1, 1, '123', 100000, 1, 0, 1, 0, '3-Axis Stabilization\r\nPortable and Foldable\r\nBuilt-In Extension Rod\r\nQuick Launch\r\nActiveTrack 5.0\r\nEasy Tutorials and One-Tap Editing\r\nMagnetic Quick-Release Design\r\nCompatible Phone Weight : 170-290 g\r\nCompatible Phone Thickness : 6.9-10 mm\r\nCompatible Phone Width : 67-84 mm\r\nOperating Time : Approx. 6 hours and 24 minutes', 'DJI_OSMO_MOBILE_6_5.jpeg'),
(2, 1, 2, '111', 100000, 1, 0, 1, 0, 'Kamera CMOS 1/2,3 inci 12MP\r\n246 gr The standard weight of the aircraft\r\nLight and Portable\r\nUp to 10km HD Video Transmission\r\n31-Min Max Flight Time\r\nClear and Crisp Imagery\r\nMax Takeoff Altitude 4000m\r\nWind Resistance 38kph (Level 5)', 'DRONE_DJI_MINI_2_SE_11.jpg'),
(3, 1, 3, '222', 400000, 1, 0, 1, 0, '4K HDR Video\r\nUnder 249 g\r\nExtended Battery Life\r\nTrue Vertical Shooting\r\nIntelligent Features\r\n38kph (Level 5) Wind Resistance\r\nBeginner-Friendly, Easy-To-Fly, and Easy-To-Use\r\nUp to 38 Minutes of Flight Time\r\nUp to 10km Range Transmission', 'DRONE_MAVIC_MINI_3_1.jpg'),
(4, 1, 4, '444', 100000, 2, 0, 2, 0, 'Lightweight Design with 10 lb Payload\r\nSupports BMPCC 6K, ALEXA Mini LF, 1D X\r\nAdvanced 1.4&quot; Full-Color LCD Touchscreen\r\nRSA Ports with NATO Mount', 'GIMBAL_DJI_RONIN_S_1.jpg'),
(5, 1, 5, '555', 125000, 3, 0, 3, 0, 'Designed for Mirrorless Cameras\r\nWireless Camera Control via Bluetooth\r\nHorizontal &amp; Vertical Modes\r\n2450mAh Battery, 10-Hour Runtime\r\nNATO Rail for Handles &amp; Accessories\r\nLightweight Design, up to 2 kg Payload\r\n1.4&quot; Full Color Touchscreen\r\nPanorama, Timelapse &amp; Tracking Functions\r\n795g Lightweight Design', 'GIMBAL_DJI_RS3_MINI_1.jpg'),
(6, 2, 6, '360', 150000, 1, 0, 1, 0, '8K305.7K60 360°Cinematic H.265 Video\r\nFor Content Creators And Videographers\r\n360° Post Reframing, Longer Runtime\r\nRugged Design, Removable Lens Guards\r\nGesture Control, DualSingle Lens Modes\r\n5.7K120 Bullet Time, 11K Time-Lapse\r\n2290mAh For 135 Minutes At 5.7K30fps\r\nFlowState Stabilization, Horizon Lock\r\n10m Waterproof, 72MP Photos\r\nApp With Edit Suite And Effects', 'Kamera_360_16.jpg'),
(7, 2, 7, 'D750', 200000, 1, 0, 1, 0, 'Sensor CMOS bingkai penuh 24MP (dengan filter AA)\r\nBalikkan ke atas/bawah layar LCD RGBW 3,2&quot; 1.229k-dot\r\nPemotretan beruntun 6,5 fps\r\nPeningkatan sistem AF Multi-CAM 3500FX II 51 titik (sensitif terhadap -3EV)\r\nSensor pengukuran RGB 91.000 piksel dengan deteksi wajah dan pengukuran titik yang terhubung ke titik AF\r\nWi-Fi bawaan\r\nPengukuran berbobot sorotan\r\nPerekaman video 1080/60p\r\nBukaan bertenaga untuk kontrol selama tayangan langsung/video\r\nMode AF Area Grup\r\nPerekaman internal dan output HDMI secara bersamaan', 'NIKON_D750.jpeg'),
(8, 2, 8, 'A7II', 150000, 14, 0, 14, 0, '24.3MP Full-Frame Exmor CMOS Sensor\r\nBIONZ X Image Processor\r\n5-Axis SteadyShot INSIDE Stabilization\r\nEnhanced Fast Hybrid AF and 5 fps Burst\r\nFull HD XAVC S Video and S-Log2 Gamma\r\n3.0&quot; 1,228.8k-Dot Tilting LCD Monitor\r\nXGA 2.36M-Dot OLED Electronic Viewfinder\r\nWeather-Resistant Magnesium Alloy Body\r\nRefined Grip &amp; Robust Lens Mount\r\nBuilt-In Wi-Fi Connectivity with NFC\r\nFilter Size : 67mm', 'SONY_A7_ii_1.jpeg'),
(9, 2, 9, 'A7III', 250000, 4, 0, 4, 0, '24MP Full-Frame Exmor R BSI CMOS Sensor\r\nBIONZ X Image Processor &amp; Front-End LSI\r\n693-Point Hybrid AF System\r\nUHD 4K30p Video with HLG &amp; S-Log3 Gammas\r\n2.36m-Dot Tru-Finder OLED EVF\r\n3.0&quot; 922k-Dot Tilting Touchscreen LCD\r\n5-Axis SteadyShot INSIDE Stabilization\r\nISO 204800 and 10 fps Shooting\r\nBuilt-In Wi-Fi and NFC, Dual SD Slots\r\nUSB Type-C Port, Weather-Sealed Design', 'SONY_A7_iii_1.jpeg'),
(10, 2, 10, 'A7IV', 375000, 1, 0, 1, 0, '33MP Full-Frame Exmor R CMOS Sensor\r\nUp to 10 fps Shooting, ISO 100-51200\r\n4K 60p Video in 10-Bit, S-Cinetone\r\n3.68m-Dot EVF with 120 fps Refresh Rate\r\n3&quot; 1.03m-Dot Vari-Angle Touchscreen LCD\r\n759-Pt. Fast Hybrid AF, Real-time Eye AF\r\nFocus Breathing Compensation\r\n5-Axis SteadyShot Image Stabilization\r\nCreative Looks and Soft Skin Effect\r\n4K 15p UVC/UAC Streaming via USB Type-C', 'SONY_A7R_iv_1.jpg'),
(11, 3, 11, 'F18GM', 150000, 5, 0, 5, 0, 'E-Mount Lens/Full-Frame Format\r\nAperture Range: f/1.8 to f/16\r\nTwo XA Elements, One Super ED Element\r\nNano AR II and Fluorine Coatings\r\nXD Linear Motor AF, Internal Focus\r\nPhysical Aperture Ring; De-Click Switch\r\nDust and Moisture-Resistant Construction\r\nRounded 9-Blade Diaphragm\r\nFilter Size : Gel Filter (Rear)\r\nIncluded :\r\n1x Sony FE 14mm f/1.8 GM Lens\r\n1x Front Cap\r\n1x Sony ALC-R1EM Rear Lens Cap\r\n1x Lens Case\r\n1x Filter Template\r\n1x Manual Book\r\n1x Kartu Garansi Resmi Sony Indonesia', 'Sony_14mm_f1_8_G_Master_12.png'),
(12, 3, 12, 'af14mm', 100000, 1, 0, 1, 0, 'E-Mount Lens/Full-Frame Format\r\nAperture Range: f/2.8 to f/22\r\nThree Aspherical and Two ED Elements\r\nUltra Multi-Coating\r\nAutofocus with Manual Focus Override\r\nRounded 7-Blade Diaphragm\r\nIntegrated Lens Hood', 'Samyang_AF_14mm_f2_8_for_Sony_FE_Mount_Full_Frame_1.jpg'),
(13, 3, 13, 'af50', 120000, 3, 0, 3, 0, 'E-Mount Lens/Full-Frame Format\r\nAperture Range: f/1.4 - f/16\r\nUltra Multi-Coating\r\nRounded 9-Blade Diaphragm\r\nFilter size : 72mm\r\nUltra-precision aspherical lenses offer soft and beautiful bokeh\r\nSmallest &amp; Lightest large-aperture standard lens\r\nNew modern design with matt finish and red ring\r\nFast &amp; quiet AF and well-controlled breathing for shooting video', 'SAMYANG_AF_50mm_F1_4_II_for_Sony_FE_1.jpg'),
(14, 3, 14, '16mmf14', 130000, 8, 0, 8, 0, 'E-Mount Lens/APS-C Format\r\n24mm (35mm Equivalent)\r\nAperture Range: f/1.4 to f/16\r\n3 FLD, 2 SLD, and 2 Aspherical Elements\r\nSuper Multi-Layer Coating\r\nStepping AF Motor\r\nRounded 9-Blade Diaphragm\r\nWeather-Sealed TSC Construction', 'Sigma_16mm_f1_4_Sony_Apsc_1.jpg'),
(15, 3, 15, '2470f28', 150000, 6, 0, 6, 0, 'E-Mount Lens/Full-Frame Format\r\nAperture Range: f/2.8 to f/22\r\nSix FLD Elements, Two SLD Elements\r\nThree Aspherical Elements', 'Sigma_24-70mm_f2_8_DG_DN_Art_Lens_for_Sony_E_1.jpg'),
(16, 4, 16, 'a100da', 150000, 1, 0, 1, 0, 'For Video Production &amp; Vlogging\r\nOutput: 34,600 Lux @ 1 meter with Hyper-Reflector\r\n5600K CCT\r\nAC Power or Optional Battery Station\r\nOnboard &amp; App Control\r\nCRI 96 | TLCI 99 | SSI 86\r\nActive Cooling\r\nBowens S Accessory Mount\r\n8 Preset Special Effects\r\nIncludes Reflector, Power Supply &amp; Cable\r\n', 'APUTURE_100D_AMARAN_1.jpg'),
(17, 4, 17, 'al528s', 100000, 2, 0, 2, 0, 'Color Temperature : 3200-6500K\r\nCRI : 96+\r\nTCLI : 97+\r\nBattery Type : Lithium-polymer Battery (3.7V 2600mAh)\r\nRated Output Power : 5W\r\nOperating Temperature : 0? to 45?\r\nOperatin Battery Life : Max Brightness &gt;2hrs / Min Brightness &gt;15hrs\r\nBattery Recharge Time : 1.5 hours via USB PD / 2 hours via USB DC 5V/2A / 3.5 hours via wireless charging\r\nDimension : 93 x 61 x 17mm', 'APUTURE_AL-528S_LED_VIDEO_1.jpg'),
(18, 4, 18, 'gad600p', 175000, 2, 0, 2, 0, 'Built-In 2.4 GHz Wireless X System\r\nCompatible with Most TTL Systems\r\n600Ws, 1/256 to 1/1 Power Output\r\nLithium-Ion Battery Powered\r\nUp to 360 Full-Power Flashes\r\nFlash Duration: 1/220 to 1/10,100 Sec\r\n1/8000 Sec High-Speed Sync\r\n0.01-0.9 Sec Recycling Time\r\n38W Modeling Lamp\r\nStable Color Temperature Mode', 'GODOX_AD600_PRO_1.jpg'),
(19, 4, 20, 'gl120c', 100000, 2, 0, 2, 0, 'Compatible with Sony ADI / P-TTL\r\nOutput: 76Ws\r\nAuto Zoom Control, Zoom Range: 28-105mm\r\n2.4 GHz Wireless X-System Transmitter', 'GODOX_FLASH_V1S_1.jpg'),
(20, 4, 19, 'gfv1s', 50000, 1, 0, 1, 0, '3300 to 5600K Variable Color Dial\r\n10 to 100% Dimming\r\n12W Power Draw\r\nAccepts Sony L-Series Batteries\r\nOn/Off Switch\r\n1/4&quot;-20 Threaded Hole\r\nIncludes Angle-Adjustable L-Type Bracket\r\nSupports Cold Shoe Mounting\r\nLightweight and Ultra-Thin\r\n', 'GODOX_LED_120C_1.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kategori_alat`
--

CREATE TABLE `tbl_kategori_alat` (
  `id_kategori_alat` int NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_kategori_alat`
--

INSERT INTO `tbl_kategori_alat` (`id_kategori_alat`, `nama_kategori`) VALUES
(1, 'Equipment'),
(2, 'Kamera'),
(3, 'Lensa'),
(4, 'Lighting');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_keranjang`
--

CREATE TABLE `tbl_keranjang` (
  `id_keranjang` int NOT NULL,
  `id_user` int NOT NULL,
  `id_alat` int NOT NULL,
  `jumlah` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_keranjang`
--

INSERT INTO `tbl_keranjang` (`id_keranjang`, `id_user`, `id_alat`, `jumlah`) VALUES
(4, 19, 5, 1),
(7, 20, 1, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_pembelian`
--

CREATE TABLE `tbl_pembelian` (
  `id_pembelian` int NOT NULL,
  `kode_pembelian` varchar(10) NOT NULL,
  `nama_alat` varchar(100) NOT NULL,
  `harga_beli` int NOT NULL,
  `jumlah_pembelian` int NOT NULL,
  `status` varchar(100) NOT NULL,
  `jenis_pembelian` varchar(50) NOT NULL,
  `tanggal_pembelian` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_pembelian`
--

INSERT INTO `tbl_pembelian` (`id_pembelian`, `kode_pembelian`, `nama_alat`, `harga_beli`, `jumlah_pembelian`, `status`, `jenis_pembelian`, `tanggal_pembelian`) VALUES
(1, 'PO001', 'Dji Osmo Mobile 6', 1167000, 1, 'disetujui', 'alat baru', '2024-08-01'),
(2, 'PO002', 'Drone Dji Mini 2 SE', 5922000, 1, 'disetujui', 'alat baru', '2024-08-02'),
(3, 'PO003', 'Drone Mavic Mini 3', 116000, 1, 'disetujui', 'alat baru', '2024-08-05'),
(4, 'PO004', 'Gimbal Dji Ronin S', 2860000, 2, 'disetujui', 'alat baru', '2024-08-08'),
(5, 'PO005', 'Gimbal Dji RS3 Mini', 2473000, 3, 'disetujui', 'alat baru', '2024-08-10'),
(6, 'PO006', 'Kamera 360', 3700000, 1, 'disetujui', 'alat baru', '2024-08-20'),
(7, 'PO007', 'Nikon D750', 15550000, 1, 'disetujui', 'alat baru', '2024-08-21'),
(8, 'PO008', 'Sony A7 II', 8200000, 14, 'disetujui', 'alat baru', '2024-08-20'),
(9, 'PO009', 'Sony A7 III', 22850000, 4, 'disetujui', 'alat baru', '2024-08-20'),
(10, 'PO010', 'Sony A7 IV', 36999000, 1, 'disetujui', 'alat baru', '2024-08-20'),
(11, 'PO011', 'Lensa Sony 14mm f1.8 G Master', 21999000, 5, 'disetujui', 'alat baru', '2024-08-21'),
(12, 'PO012', 'Samyang AF 14mm f2.8 for Sony FE Mount Full Frame', 11599000, 1, 'disetujui', 'alat baru', '2024-08-21'),
(13, 'PO013', 'Samyang AF 50mm f1.4 Mark II for Sony FE Mount Full Frame', 10000000, 3, 'disetujui', 'alat baru', '2024-08-21'),
(14, 'PO014', 'Sigma 16mm f1.4 Sony Apsc', 6630000, 8, 'disetujui', 'alat baru', '2024-08-21'),
(15, 'PO015', 'Sigma 24-70mm f2.8 DG DN Art for Sony FE Mount Full Frame', 16499000, 6, 'disetujui', 'alat baru', '2024-08-21'),
(16, 'PO016', 'Aputure 100D Amaran', 3021000, 1, 'disetujui', 'alat baru', '2024-08-22'),
(17, 'PO017', 'Aputure Al-528s LED Video', 2000000, 2, 'disetujui', 'alat baru', '2024-08-22'),
(18, 'PO018', 'Godox AD600 Pro', 8800000, 2, 'disetujui', 'alat baru', '2024-08-22'),
(19, 'PO019', 'Godox Flash V1S', 2945000, 1, 'disetujui', 'alat baru', '2024-08-22'),
(20, 'PO020', 'Godox LED 120C', 550000, 2, 'disetujui', 'alat baru', '2024-08-22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_penyewaan`
--

CREATE TABLE `tbl_penyewaan` (
  `id_penyewaan` int NOT NULL,
  `kode_penyewaan` varchar(10) NOT NULL,
  `id_user` int NOT NULL,
  `tanggal_checkout` datetime NOT NULL,
  `tanggal_sewa` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `metode_pembayaran` varchar(15) NOT NULL,
  `opsi_pembayaran` varchar(15) NOT NULL,
  `status_pembayaran` varchar(15) NOT NULL,
  `status_pelunasan` varchar(100) NOT NULL,
  `status_penyewaan` varchar(15) NOT NULL,
  `keterangan_ditolak` varchar(100) DEFAULT NULL,
  `keterangan_pengembalian` varchar(100) DEFAULT NULL,
  `detail_pengembalian` text,
  `sub_total` int NOT NULL,
  `batas_waktu_upload` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_penyewaan`
--

INSERT INTO `tbl_penyewaan` (`id_penyewaan`, `kode_penyewaan`, `id_user`, `tanggal_checkout`, `tanggal_sewa`, `tanggal_kembali`, `no_telp`, `metode_pembayaran`, `opsi_pembayaran`, `status_pembayaran`, `status_pelunasan`, `status_penyewaan`, `keterangan_ditolak`, `keterangan_pengembalian`, `detail_pengembalian`, `sub_total`, `batas_waktu_upload`) VALUES
(1, '190820241', 17, '2024-08-19 02:20:14', '2024-08-19', '2024-08-19', '12233', 'cash', 'lunas', 'diterima', 'sudah lunas', 'disewakan', NULL, 'baik', '', 100000, '2024-08-19 02:20:14'),
(2, '190820242', 17, '2024-08-19 03:24:53', '2024-08-19', '2024-08-19', '123', 'transfer', 'lunas', 'dibatalkan', 'belum lunas', 'disewakan', NULL, NULL, NULL, 100000, '2024-08-19 03:34:53'),
(4, '220820244', 20, '2024-08-22 20:26:12', '2024-08-22', '2024-08-23', '081394635600', 'transfer', 'lunas', 'diterima', 'sudah lunas', 'disewakan', NULL, NULL, NULL, 200000, '2024-08-22 20:36:12'),
(5, '240820245', 17, '2024-08-24 23:52:29', '2024-08-24', '2024-08-24', '123', 'transfer', 'lunas', 'diterima', 'sudah lunas', 'disewakan', NULL, NULL, NULL, 100000, '2024-08-25 00:02:29'),
(6, '240820246', 17, '2024-08-24 23:56:40', '2024-08-30', '2024-08-30', '123', 'transfer', 'lunas', 'diterima', 'sudah lunas', 'disewakan', NULL, NULL, NULL, 100000, '2024-08-25 00:06:40'),
(7, '260820247', 17, '2024-08-26 13:07:00', '2024-08-31', '2024-08-31', '098765432112', 'transfer', 'lunas', 'diterima', 'sudah lunas', 'disewakan', NULL, NULL, NULL, 100000, '2024-08-26 13:17:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_penyewaan_detail`
--

CREATE TABLE `tbl_penyewaan_detail` (
  `id_penyewaan_detail` int NOT NULL,
  `id_penyewaan` int NOT NULL,
  `id_alat` int NOT NULL,
  `jumlah` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_penyewaan_detail`
--

INSERT INTO `tbl_penyewaan_detail` (`id_penyewaan_detail`, `id_penyewaan`, `id_alat`, `jumlah`) VALUES
(1, 1, 1, 1),
(2, 2, 2, 1),
(4, 4, 1, 1),
(5, 5, 1, 1),
(6, 6, 1, 1),
(7, 7, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `id_transaksi` int NOT NULL,
  `id_penyewaan` int NOT NULL,
  `bukti_transfer_lunas` varchar(255) DEFAULT NULL,
  `tgl_transfer_lunas` date DEFAULT NULL,
  `bukti_transfer_dp_awal` varchar(255) DEFAULT NULL,
  `tgl_transfer_dp_awal` date DEFAULT NULL,
  `bukti_transfer_dp_akhir` varchar(255) DEFAULT NULL,
  `tgl_transfer_dp_akhir` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_transaksi`
--

INSERT INTO `tbl_transaksi` (`id_transaksi`, `id_penyewaan`, `bukti_transfer_lunas`, `tgl_transfer_lunas`, `bukti_transfer_dp_awal`, `tgl_transfer_dp_awal`, `bukti_transfer_dp_akhir`, `tgl_transfer_dp_akhir`) VALUES
(1, 5, 'GODOX_LED_120C_1.jpg', '2024-08-24', NULL, NULL, NULL, NULL),
(2, 6, 'GODOX_LED_120C_11.jpg', '2024-08-24', NULL, NULL, NULL, NULL),
(3, 7, 'GODOX_LED_120C_12.jpg', '2024-08-26', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int NOT NULL,
  `id_role` int NOT NULL,
  `nama_lengkap` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `id_role`, `nama_lengkap`, `email`, `password`) VALUES
(1, 1, 'admin cihuyyyy', 'Admin@gmail.com', '$2y$10$ru2H91YzCwmTT6O6SiHyL.qyLt8X3Bu5L8TXWl/TpzhRrsxteM4ZC'),
(6, 2, 'Owner', 'Owner@gmail.com', '$2y$10$zPWpTayHyhC7A5snCT8bWuy1AyPF025MGWekuUVSA5M7Jc9SsPtai'),
(13, 3, 'Hanseee', 'kamilfarhan223@gmail.com', '$2y$10$2GU71CBUUr9CbA1rF9QUreKexjQP3GGf85nQ7C1I72VzjgbTtpg1O'),
(16, 3, 'Pepy Pratama', 'pratamapepy0@gmail.com', '$2y$10$rbtSaGPwbR6stK9vwCiFL.dBP6kNOjMEl1uVo9CUAy0Ygxr4JFlxS'),
(17, 3, 'Pepy Pratama', 'pepypratama128@gmail.com', '$2y$10$36Z6inNY53wp6zzjHsO1ReU4zxq.LfzEUS67ZOKkT9fkushCX6h9y'),
(18, 3, 'farahiyah', 'farahiyahnurdianaputri@gmail.com', '$2y$10$eOsEJgQomzXKXVXqxFeKBeDQY/tjJmfZRC4J/wvjBq9WqJCbaEt.C'),
(19, 3, 'Tari', 'hai.tarisannisa@gmail.com', '$2y$10$Zl9W1HDUlHq1bEND3QommetMI8MjtGda3N2ntBWJFd/u4cwsd8lL6'),
(20, 3, 'alief', 'aliefalvian3@gmail.com', '$2y$10$plFePKXeOkNdYbH7qmI3zOC1aI4HQgNt3.z9wfk5d/2nTRFvWEOj6');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user_role`
--

CREATE TABLE `tbl_user_role` (
  `id_role` int NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tbl_user_role`
--

INSERT INTO `tbl_user_role` (`id_role`, `role`) VALUES
(1, 'Admin'),
(2, 'Owner'),
(3, 'User');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_alat`
--
ALTER TABLE `tbl_alat`
  ADD PRIMARY KEY (`id_alat`),
  ADD KEY `fk_kategori_alat` (`id_kategori_alat`),
  ADD KEY `fk_pembelian` (`id_pembelian`);

--
-- Indeks untuk tabel `tbl_kategori_alat`
--
ALTER TABLE `tbl_kategori_alat`
  ADD PRIMARY KEY (`id_kategori_alat`);

--
-- Indeks untuk tabel `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  ADD PRIMARY KEY (`id_keranjang`),
  ADD KEY `fk_user` (`id_user`),
  ADD KEY `fk_alat` (`id_alat`);

--
-- Indeks untuk tabel `tbl_pembelian`
--
ALTER TABLE `tbl_pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indeks untuk tabel `tbl_penyewaan`
--
ALTER TABLE `tbl_penyewaan`
  ADD PRIMARY KEY (`id_penyewaan`),
  ADD KEY `fk_userr` (`id_user`);

--
-- Indeks untuk tabel `tbl_penyewaan_detail`
--
ALTER TABLE `tbl_penyewaan_detail`
  ADD PRIMARY KEY (`id_penyewaan_detail`),
  ADD KEY `fk_penyewaannn` (`id_penyewaan`),
  ADD KEY `fk_alattttt` (`id_alat`);

--
-- Indeks untuk tabel `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `fk_penyewaann` (`id_penyewaan`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `fk_role` (`id_role`);

--
-- Indeks untuk tabel `tbl_user_role`
--
ALTER TABLE `tbl_user_role`
  ADD PRIMARY KEY (`id_role`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_alat`
--
ALTER TABLE `tbl_alat`
  MODIFY `id_alat` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tbl_kategori_alat`
--
ALTER TABLE `tbl_kategori_alat`
  MODIFY `id_kategori_alat` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  MODIFY `id_keranjang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tbl_pembelian`
--
ALTER TABLE `tbl_pembelian`
  MODIFY `id_pembelian` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tbl_penyewaan`
--
ALTER TABLE `tbl_penyewaan`
  MODIFY `id_penyewaan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_penyewaan_detail`
--
ALTER TABLE `tbl_penyewaan_detail`
  MODIFY `id_penyewaan_detail` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  MODIFY `id_transaksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tbl_user_role`
--
ALTER TABLE `tbl_user_role`
  MODIFY `id_role` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_alat`
--
ALTER TABLE `tbl_alat`
  ADD CONSTRAINT `fk_kategori_alat` FOREIGN KEY (`id_kategori_alat`) REFERENCES `tbl_kategori_alat` (`id_kategori_alat`),
  ADD CONSTRAINT `fk_pembelian` FOREIGN KEY (`id_pembelian`) REFERENCES `tbl_pembelian` (`id_pembelian`);

--
-- Ketidakleluasaan untuk tabel `tbl_keranjang`
--
ALTER TABLE `tbl_keranjang`
  ADD CONSTRAINT `fk_alat` FOREIGN KEY (`id_alat`) REFERENCES `tbl_alat` (`id_alat`),
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `tbl_penyewaan`
--
ALTER TABLE `tbl_penyewaan`
  ADD CONSTRAINT `fk_userr` FOREIGN KEY (`id_user`) REFERENCES `tbl_user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `tbl_penyewaan_detail`
--
ALTER TABLE `tbl_penyewaan_detail`
  ADD CONSTRAINT `fk_alattttt` FOREIGN KEY (`id_alat`) REFERENCES `tbl_alat` (`id_alat`),
  ADD CONSTRAINT `fk_penyewaannn` FOREIGN KEY (`id_penyewaan`) REFERENCES `tbl_penyewaan` (`id_penyewaan`);

--
-- Ketidakleluasaan untuk tabel `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD CONSTRAINT `fk_penyewaann` FOREIGN KEY (`id_penyewaan`) REFERENCES `tbl_penyewaan` (`id_penyewaan`);

--
-- Ketidakleluasaan untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD CONSTRAINT `fk_role` FOREIGN KEY (`id_role`) REFERENCES `tbl_user_role` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
