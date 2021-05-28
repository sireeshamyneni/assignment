<?php
use PHPUnit\Framework\TestCase;

class CustomDataControllerTest extends TestCase
{
    public function testUserInput()
    {
        $variable = "hello"; 
    
        // Assert function to test whether given 
        // variable is Null or not 
        $this->assertNull( 
            $variable, 
            "variable is null or not"
        ); 
    }
}
?>