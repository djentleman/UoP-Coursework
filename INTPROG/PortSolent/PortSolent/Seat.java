
/**
 * Write a description of class Seat here.
 * 
 * @author (your name) 
 * @version (a version number or a date)
 */
public class Seat
{
    // instance variables - replace the example below with your own
    private int column;
    private int row;
    private boolean isBooked;

    /**
     * Constructor for objects of class Seat
     */
    public Seat(int co, int ro)
    {
        column = co;
        row = ro;
        isBooked = false;
    }
    
    
    public boolean getIsBooked()
    {
        return isBooked;
    }
    
    public int getCo()
    {
        return column;
    }
    
    public int getRo()
    {
        return row;
    }
    
    /**
     * An example of a method - replace this comment with your own
     * 
     * @param  y   a sample parameter for a method
     * @return     the sum of x and y 
     */
    public void book()
    {
        System.out.println("Your seat has been booked");
        isBooked = true;
    }
    
    public void unBook()
    {
        System.out.println("Your seat has been been unbooked");
        isBooked = false;
    }
    
}


   
