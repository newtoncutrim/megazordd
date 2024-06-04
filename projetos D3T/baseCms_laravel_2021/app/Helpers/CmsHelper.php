<?php

namespace App\Helpers;

use App\Traits\UploadTrait;
use Illuminate\Support\Facades\Storage;

class CmsHelper
{
	use UploadTrait;

	/* Upload de arquivos
		
		@Exemplo (Store)
			$variavel = CmsHelper::SelectList('diretório',$arquivo,800);

		@Exemplo (Update)
			$variavel = CmsHelper::SelectList('diretório',$arquivo,800,$arquivo_antigo);

	*/
	public static function UploadFile(string $diretory_name, $data_file, ?int $size = null, ?string $old_file = null)
	{
		if (!empty($data_file)) {
			if (!$file = self::uploadValidFile($diretory_name, $data_file, $size)) {
				return redirect()->back()->withErrors(['file' => 'O arquivo não pode ser carregado'])->withInput();
			} else {
				if ($old_file) {
					$path = str_replace('storage/', '', $old_file);

					if (Storage::exists($path)) {
						unlink($old_file);
					}
				}

				return !empty($file) ? $file : '';
			}
		}
	}

	/*
	 	Retorna o valor de campos: <input type="checkbox"/>
		
		@Exemplo 
			$variavel = CmsHelper::CheckboxCheck(isset($checkbox));	*
	*/
	public static function CheckboxCheck(bool $checkbox)
	{
		if ($checkbox) {
			return 1;
		}

		return 0;
	}

	/* Retorna uma lista para o UiSelect
		
		@Exemplo 
			$variavel = CmsHelper::SelectList($dados,'id','name');

	*/
	public static function SelectList(object $data, string $valuefield, string $labelfield)
	{
		$list = [];

		foreach ($data as $key => $item) {
			$list[$key]['value'] = $item[$valuefield];
			$list[$key]['label'] = $item[$labelfield];
		}

		return $list;
	}

}
