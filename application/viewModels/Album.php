<?php

	class Album {
		public $id;
		public $name;
		public $cover;

		public function __construct($id, $name, $cover) {
			$this->id = $id;
			$this->name = $name;
			$this->cover = $cover;
		}

		public function getPhotoOfAlbumUrl() {
			return 'showPhotosOfAlbum/'.$this->id;
		}
	}

?>