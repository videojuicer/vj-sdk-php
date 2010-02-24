<?php
class Videojuicer_Entity_List implements Iterator, Countable {
	
	protected $items = array();
	

    
    ## For Iterator
    /**
     * Reset the iterator
     *
     */
    public function rewind() {
        reset($this->items);
    }

    /**
     * Get the current item
     *
     * @return Object
     */
    public function current() {
        $p = current($this->items);
        return $p;
    }

    
    /**
     * Get the current index position
     *
     * @return int
     */
    public function key() {
        $var = key($this->items);
        return $var;
    }

    /**
     * Move the pointer to the next element and return that element
     *
     * @return Object
     */
    public function next() {
        $var = next($this->items);
        return $var;
    }

    /**
     * Check whether there is an entry at the current pointer
     *
     * @return boolean
     */
    public function valid() {
        $var = $this->current() !== false;
        return $var;
    }
    
    
    
    
    ## For Countable
    /**
     * Count the number of items in the list
     *
     * @return int
     */
    public function count() {
    	return sizeof($this->items);
    }
	
	
}
?>