import java.util.ArrayList;
import java.io.*;
import java.util.StringTokenizer;
/**
 * The class Screen is representative of a single screen within the Cinema. It contains
 * details of the Screen itself, as well as the schedule for it that day.
 * 
 * @author Craig Wilson, Todd Perry, Sam Borni
 * @version 15/03/2012
 */
public class Screen
{
    private int width;
    private int height;
    private int screenID;
    private String isThreeD;
    private ShowSchedule schedule;
    
    /**
     * The constructor for the Screen class. Takes 4 different parameters in order to 
     * initalise a Screen object.
     * 
     * @param screenID An integer designating the ID of that specific screen.
     * @param width The width of the screen.
     * @param height The height of the screen.
     * @param isThreeD Whether or not the screen has 3D capabilities. 
     */
    public Screen(int screenID, int width, int height, String isThreeD)
    {
        this.screenID = screenID;
        this.width = width;
        this.height = height;
        this.isThreeD = isThreeD;
        schedule = new ShowSchedule();
    }
    
    /**
     * Prints the screen details of the selected screen to the terminal window.
     */
    public void displayScreenDetails()
    {
        System.out.print("Screen No# ");
        System.out.println(screenID);
        System.out.println("");
        schedule.printSchedule();
    }
    
    /**
     * The getScreenID method returns the ID number of the selected screen.
     * 
     * @return An integer representing the screenID of the selected screen.
     */
    public int getScreenID()
    {
        return screenID;
    }
    
    public void clearScreen()
    {
        schedule.clearSchedule();
    }
    /**
     * The getWidth method returns the width of the selected screen.
     * 
     * @return An integer representing the width of the selected screen.
     */
    public int getWidth()
    {
        return width;
    }
    
    public void manuallyFill()
    {
        schedule.getDetailsForFill();
    }
    
    /**
     * The getHeight method returns the height of the selected screen.
     * 
     * @return An integer representing the height of the selected screen.
     */
    public int getHeight()
    {
        return height;
    }
    
    /**
     * The isThreeD methods returns whether or not the screen has 3D capabilities.
     * 
     * @return A string stating if the screen has 3D or not.
     */
    public String isThreeD()
    {
        return isThreeD;
    }
    
    /**
     * The getSchedule method fills the ShowSchedule with a specific schedule for this
     * screen.
     */
    public void getSchedule() throws FileNotFoundException
    {
        schedule.fillSchedule();
    }
    
    /**
     * Searches the schedule of this film for a specific film entered by the user within the
     * interface.
     * 
     * @param film The film to be searched for of type String.
     */
    public void search(String film)
    {
        schedule.searchForFilm(film);
    }
    
    public void bookSeat(int co, int ro, int show)
    {
       
        schedule.bookSeat(co, ro, show);
       
    }
       
    public void unBookSeat(int co,int ro,int show)
    {
         
        schedule.unBookSeat(co,ro,show);
        
    }
    
     public boolean isBookSeat(int co,int ro,int show)
    {
        boolean isBooked = false;
        isBooked= schedule.checkSeatIsBooked(co, ro, show);
        return isBooked;
        
    }
}
