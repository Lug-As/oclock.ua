<?php


namespace app\widgets\pagination;


class Pagination
{
	public $currentPage;
	public $totalProducts;
	public $perPage;
	public $countPages;
	public $uri;

	public function __construct($currentPage, $perPage, $totalProducts)
	{
		$this->perPage = $perPage;
		$this->totalProducts = $totalProducts;
		$this->countPages = $this->getCountPages();
		$this->currentPage = $this->getCurrentPage($currentPage);
		$this->uri = $this->getUri();
	}

	public function getOffset()
	{
		if ($this->currentPage and $this->perPage) {
			return (($this->currentPage - 1) * $this->perPage);
		}
		return 0;
	}

	public function getHTML()
	{
		$back = null;
		$first = null;
		$fillingBack = null;
		$page1back = null;
		$page2back = null;
		$currentPage = null;
		$page1forward = null;
		$page2forward = null;
		$fillingForward = null;
		$last = null;
		$forward = null;
		$cp = $this->currentPage;
		$url = PATH . $this->uri;
		if ($this->countPages == 1) {
			return '';
		}
		if ($cp > 1) {
			$back = "<li><a href='{$url}&page=" . ($cp - 1) . "'>&lt;</a></li>";
			$page1back = "<li><a href='{$url}&page=" . ($cp - 1) . "'>" . ($cp - 1) . "</a></li>";
		} else {
			$back = "<li class='disabled'><a>&lt;</a></li>";
		}
		if ($cp < $this->countPages) {
			$forward = "<li><a href='{$url}&page=" . ($cp + 1) . "'>&gt;</a></li>";
			$page1forward = "<li><a href='{$url}&page=" . ($cp + 1) . "'>" . ($cp + 1) . "</a></li>";
		} else {
			$forward = "<li class='disabled'><a>&gt;</a></li>";
		}
		if ($cp > 2) {
			$page2back = "<li><a href='{$url}&page=" . ($cp - 2) . "'>" . ($cp - 2) . "</a></li>";
		}
		if ($cp < ($this->countPages - 1)) {
			$page2forward = "<li><a href='{$url}&page=" . ($cp + 2) . "'>" . ($cp + 2) . "</a></li>";
		}
		if ($cp > 3) {
			$first = "<li><a href='{$url}&page=1'>1</a></li>";
		}
		if ($cp < ($this->countPages - 2)) {
			$last = "<li><a href='{$url}&page={$this->countPages}'>{$this->countPages}</a></li>";
		}
		if ($cp > 4) {
			$fillingBack = "<li><a>...</a></li>";
		}
		if ($cp < ($this->countPages - 3)) {
			$fillingForward = "<li><a>...</a></li>";
		}
		$currentPage = "<li class='active'><a>{$cp}</a></li>";
		return '<ul class="pagination">' . $back . $first . $fillingBack . $page2back . $page1back . $currentPage . $page1forward . $page2forward . $fillingForward . $last . $forward . '</ul>';
	}

	public function __toString()
	{
		return $this->getHTML();
	}

	protected function getCurrentPage($page)
	{
		if ($page <= 0) {
			$page = 1;
		}
		if ($page > $this->countPages) {
			$page = $this->countPages;
		}
		return $page;
	}

	protected function getUri()
	{
		$totalUri = $_SERVER['REQUEST_URI'];
		$totalUri = explode('?', $totalUri);
		$uri = $totalUri[0];
		if (isset($totalUri[1])) {
			$uriArray = explode('&', $totalUri[1]);
			foreach ($uriArray as $key => $item) {
				$param = explode('=', $item);
				if ($param[0] == 'page') {
					unset($uriArray[$key]);
					break;
				}
			}
			$uri .= "?" . implode('&', $uriArray);
		}
		return urldecode($uri);
	}

	protected function getCountPAges()
	{
		return ceil($this->totalProducts / $this->perPage);
	}
}