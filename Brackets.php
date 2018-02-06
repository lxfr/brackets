<?php
class Brackets
{

	//анализируемые скобки не подлежат изменению из вне
	private $brackets = array(
        '(' => ')',
        '[' => ']',
        '{' => '}',
    );	
	
	//здесь храним 1 раз сгенерированные массивы для поиска
	private $openBrackets = [];
	private $closedBrackets = [];
	private $reverseBrackets = [];
	
	//в конструкторе 1 раз генерируем нужные для поиска массивы
	public function __construct()
	{
		//массив для поиска открытых скобок
		$this->openBrackets = array_keys($this->brackets);
		
		//массив для поиска закрытых скобок
		$this->closedBrackets = array_values($this->brackets);
		
		//массив вида "закрытая скобка" => "открытая скобка"
		$this->reverseBrackets = array_flip($this->brackets);
	}
	
	public function analize(string $s)
	{
		//пустые переменные будут означать результат false	
		if (empty($s))
		{
			return false;
		}
		
		//типы данных, отличные от string, будут означать результат false	
		if (gettype($s)!='string')
		{
			return false;
		}
		
		//массив найденных открытых скобок					
		$searchOpen = array();
		
		//обходим все символы и ищем открытые и закрытые скобки
		for($i=0; $i<strlen($s); $i++)
		{
			//смотрим на каждый символ
			$analizeSymbol = $s{$i};
			
			//если нашли открытую скобку, помещаем ее в массив найденных открытых скобок
			if (in_array($analizeSymbol, $this->openBrackets))
			{
				$searchOpen[] = $analizeSymbol;
			}
				
			//если нашли закрытую скобку, сравниваем с последней найденной открытой
			else if (in_array($analizeSymbol,$this->closedBrackets))
			{			
				//не нашли пару для закрытой скобки 
				//в числе последних найденных открытых	
				if (end($searchOpen)!=$this->reverseBrackets[$analizeSymbol]) 
				{
					//синтаксис неверен, т.к.
					return false;
				}
				else
				{
					//удаляем последний элемент массива в открытых скобках
					array_pop($searchOpen);
				}
					
			}
			//другие символы на анализируем.
		}

		//В финале нужно проверить, что больше открытых найденных с закрытыми парами нет
		if (empty($stack))
		{
			//следовательно синтаксис верен
			return true;
		}
		else
		{
			//иначе синтаксис неверен
			return false;
		}
	}
}

$brackets = new Brackets();

var_dump($brackets->analize('( [ ] { } )')); //вернет true
var_dump($brackets->analize('какой-то текст([{}])')); //вернет true
var_dump($brackets->analize(']неверный синтаксис скобок[([{}])')); //вернет false
var_dump($brackets->analize('{{тест{[123]}}}')); //вернет true
var_dump($brackets->analize('([{}])()[]')); //вернет true
var_dump($brackets->analize('[тест](тест{})')); //вернет true