<div class="navbar navbar-inverse navbar-fixed-top">
	<ul id="menu1">
		<li>
			<h3><a href="<?php echo base_url(); ?>index.php/system_site/bmt_sistem">BMT Al-Hikma</a></h3>
		</li>
		<li>
			<a href="#">File</a>
			<ul>
				<li>
					<a href="<?php echo base_url(); ?>index.php/system_site/form_anggota">Data Nasabah</a>
				</li>
				<li>
					<a href="<?php echo base_url(); ?>index.php/system_site/form_simpanan">Data Simpanan</a>
				</li>
				<li>
					<a href="#">Data Pinjaman</a>
				</li>
				<li></li>
				<li>
					<a href="<?php echo base_url(); ?>index.php/system_site/form_sandi_transaksi">Form Sandi Transaksi</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="#">Cetak</a>
			<ul>
				<li>
					<a href="<?php echo base_url(); ?>index.php/system_site/form_cetak_buku_tabungan">Buku Tabungan</a>
				</li>
				<li>
					<a href="#">Bukti Simpan</a>
				</li>
				<li>
					<a href="#">Surat Balasan Pinjaman</a>
				</li>
				<li>
					<a href="#">Surat Tanda Terima Pinjaman</a>
				</li>
				<li>
					<a href="#">Cetak Angsuran Pinjaman</a>
				</li>
				<li></li>
				<li>
					<a href="#">Cetak Lain-Lain</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="#">Laporan</a>
			<ul>
				<li>
					<a href="#">Lap Data Peminjaman</a>
				</li>
				<li>
					<a href="#">Lap Simpanan Anggota</a>
				</li>
				<li>
					<a href="#">Lap Pinjaman Anggota</a>
				</li>
				<li>
					<a href="#">Lap Angsuran</a>
				</li>
				<li></li>
				<li>
					<a href="#">Another link</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="#">Tools</a>
			<ul>
				<li>
					<a href="#">User</a>
				</li>
				<li>
					<a href="#">Tema</a>
				</li>
				<li></li>
				<li>
					<a href="#">Testimoni</a>
				</li>
			</ul>
		</li>
		<li>
			<input type="text" placeholder="Search">
		</li>
		<li>
			<a href="#"><?php echo $this -> session -> userdata('nama'); ?></a>							
		</li>
		<li>
			<?php echo anchor('system_site/keluar', 'Keluar'); ?>
		</li>
	</ul>
</div>
