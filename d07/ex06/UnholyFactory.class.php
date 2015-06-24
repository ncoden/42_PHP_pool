<?php

class UnholyFactory
{
	private				$_types;

	public function		absorb( $fighter )
	{
		if (is_a($fighter, Fighter))
		{
			$class = get_class($fighter);
			if (!isset($this->_types[$fighter->type]))
			{
				$this->_types[$fighter->type] = $class;
				echo ("(Factory absorbed a fighter of type ".$fighter->type.")\n");
			}
			else
				echo ("(Factory already absorbed a fighter of type ".$fighter->type.")\n");
		}
		else
			echo ("(Factory can't absorb this, it's not a fighter)\n");
	}

	public function		fabricate( $type )
	{
		if (isset($this->_types[$type]))
		{
			echo ("(Factory fabricates a fighter of type ".$type.")\n");
			return (new $this->_types[$type]);
		}
		else
			echo ("(Factory hasn't absorbed any fighter of type ".$type.")\n");

	}
}

?>