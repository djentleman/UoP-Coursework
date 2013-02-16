import java.util.ArrayList;
import java.io.*;
import java.util.StringTokenizer;
/**
 * This Cinema class is representive of a single cinema object. It stores an
 * Array List of screens and how many screens this particular cinema contains. 
 * 
 * @author Craig Wilson, Todd Perry, Sam Borni
 * @version 15/03/2012
 */
public class Cinema
{
    private ArrayList<Screen> screens;
    private CreateScreenArray array;
    private Screen screen;
    private int noOfScreens;    

    /**
     * Constructs a Cinema class. Fills it with the default number of 
     * screens (in this case, 4) and fills those screens with a randomly 
     * generated film schedule.
     */
    
    public Cinema() throws FileNotFoundException
    {
        noOfScreens = 4;
        screens = new ArrayList<Screen>();
        array = new CreateScreenArray();
        for(int screenNumber = 0; screenNumber < noOfScreens; screenNumber++){
            screens.add(array.getScreen(screenNumber));
            screens.get(screenNumber).getSchedule();
        }
    }
    
    /**
     * The method displayCinemaSchedule displays the cinema schedule
     * for a specific screen requested by the user through the interface.
     * 
     * @param screenID The entered screen number the user wishes to find out about.
     */
    public void displayCinemaSchedule(int screenID) throws FileNotFoundException
    {
            screens.get(screenID - 1).displayScreenDetails();
    }
    
    /**
     * TO BE COMPLETED
     */
    
    public void manuallyFillSchedule(int screenNo)
    {
        Screen screenToFill = screens.get(screenNo);
        screenToFill.manuallyFill();
    }
    
    public void addScreen(Screen a_Screen)
    {
      
    }
    
    /**
     * The method getNoOfScreens returns the number of screens currently in this 
     * cinema object. By default, it is set to 4.
     * 
     * @return An integer stating the number of screens in the cinema.
     */
    public int getNoOfScreens()
    {
        return noOfScreens;
    }
    
    public void clearScreen(int screenNo)
    {
        Screen screenToClear = screens.get(screenNo);
        screenToClear.clearScreen();
    }
    
    
    /**
     * TO BE COMPLETED
     */
    public ArrayList<Show> getListOfShows()
    {
        // to be completed
        return null;
    }
    
    /**
     * The method searchFilm searches the cinema schedule for a specific film by
     * checking each screen individually. 
     * 
     * @param filmSearch The title of the film you are searching for. It is of
     * type String.
     */
      public void searchFilm(String filmSearch)throws FileNotFoundException
    {
        for(Screen currentScreen : screens){
            currentScreen.search(filmSearch);
            }   
    }
    
    public boolean validateSeatBook(int co, int ro, int screenNo )
    {
        for(Screen currentScreen : screens){
            if(currentScreen.getWidth() <= co || co <= 0){
                System.out.println("The seat could not be booked, please enter a valid collumn number");
                return false;
            }
            else if(currentScreen.getHeight() <= ro || ro <= 0 ){
                System.out.println("The seat could not be booked, please enter a valid row number");
                return false;
            }
            
            if ((screenNo > (screens.size() )) ||(screenNo < 1 )) {
                System.out.println("You cannot book using this screenid");
                System.out.println(screens.size());
                return false;
            }
        }
        return true;
    }
    
    public void bookSeat(int co, int ro, int show, int screenNo)
    {
        boolean isValid = validateSeatBook(co, ro, screenNo);
        if(isValid == true){
            screens.get(screenNo - 1).bookSeat(co, ro, show);
        }
    }
    
    public void unBookSeat(int co, int ro, int show, int screenNo)
    {
           screens.get(screenNo - 1).unBookSeat(co, ro, show);
    }
    
    public void printSeatLayout( int screenNO ,int show)
    {
      
        
           Screen currentScreen = screens.get(screenNO - 1);
            
             
           for( int i = 1;  i < (currentScreen.getHeight()+1); i ++){
               if(i < 10){ 
               System.out.print(" " +i);
            }
            else{
                System.out.print(i);
            }
               
                
           for (int j = 1; j < (currentScreen.getWidth()+1); j++){
               boolean test = currentScreen.isBookSeat(i, j, show);
               if(test == true){
                   System.out.print("[X]");
                }
               
               else{
               System.out.print("[ ]");
            }
            }
               
              System.out.println("");
            }
            
            
        
       System.out.print("  ");
     
        for ( int k = 1; (k < currentScreen.getWidth()+1); k++){
            if(k < 10){
            System.out.print(" " + k + " ");
        }
        else{
             System.out.print( " " + k );
            }
        }
        
        System.out.println("");
    }
    
    public int getSeatsLeft(int screenNO, int show)
    {
       Screen currentScreen = screens.get(screenNO - 1);
            int seatsLeft =0;
             
           for( int i = 1;  i < (currentScreen.getHeight()+1); i ++){
             
               
                
           for (int j = 1; j < (currentScreen.getWidth()+1); j++){
               boolean test = currentScreen.isBookSeat(i, j, show);
               if (test == false){
                   seatsLeft++;
                }
            }
        
            }

             return seatsLeft;  
    }
    
    public void bookGroupSeats(int groupSize, int screenNo, int show)
    {
        boolean seatsFound = false;
        int freeSeatCounter;
        Screen currentScreen = screens.get(screenNo - 1);
        int screenWidth = currentScreen.getWidth();
        int screenHeight = currentScreen.getWidth();
        int row = 1;
        int col = 1;
        if(groupSize > screenWidth){
            System.out.print("the group you have entered was too big, please enter a smaller group");
        }
        else{
            while(seatsFound == false){
                for(int i = 1; i < screenHeight; i++){
                    for(int j = 1; j < (screenWidth - groupSize); j++){
                        freeSeatCounter = 0;
                        for(int k = 0; k < groupSize - 1; k++){
                            if(currentScreen.isBookSeat(i, (j + k), show) == false){
                                freeSeatCounter++;
                            }
                            else{
                                break;
                            }
                            if(freeSeatCounter == (groupSize - 1)){
                                row = j;
                                col = i;
                                seatsFound = true;
                                break;
                            }
                    }
                        if(seatsFound == true){
                            break;
                        }
                    }
                    if(seatsFound == true){
                        break;
                    }
                }
            }
            for(int x = 0; x < (groupSize); x++){
                bookSeat(col,(row + x), show, screenNo);
            }
        } 
    }

}

