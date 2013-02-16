import java.util.*;
import java.io.*;
import java.util.StringTokenizer;
/**
 * The ShowSchedule class stores the Cinema class' list of shows.
 * 
 * @author Robert Topp 
 * @version 27/02/12
 */
public class ShowSchedule
{
    private ArrayList<Show> shows;
    private int startHour;
    private int min;
    private boolean enableStart; 

    /**
     * Constructor for objects of class ShowSchedule
     */
    public ShowSchedule()
    {
        shows = new ArrayList<Show>();
       // this.startHour = 11;
        this.min = 0;
        enableStart = true;
    }

    /**
     * Possible method headers - they may need to change. 
     * Commenting needs to be done correctly.
     */
    
    public void addShow(Show a_Show)
    {
        shows.add(a_Show);
    }
    public void printSchedule()
    {
        for(Show currentShow : shows){
            currentShow.displayDetails();
        }
    }
    public ArrayList<Show> getListOfShows()
    {
        //to be completed
        return null;
    }
    public void clearSchedule()
    {
        shows.clear();
    }
    
    public void fillSchedule() throws FileNotFoundException 
    {
        startHour = 11;
        while( enableStart != false){
           if( (startHour >= 22) ){
               enableStart = false;
            }
            Show currentShow = new Show(startHour);
            if(((startHour + currentShow.getFilmDuration()) <= 23) && ((int)currentShow.getFilmDuration() > 1)){
                enableStart = true;
                this.addShow(currentShow);
                //System.out.print("Start time");
                //System.out.print(startHour +":00");
                //System.out.print("   ");
                //System.out.print(currentShow.getFilmDuration());
                //System.out.println("   ");
                int lenghtOfFilm = (int)currentShow.getFilmDuration();
                startHour = (startHour + lenghtOfFilm);
                
                
            }
         
            
        }
        
        
        //System.out.println("The Program Has Ended");
           
    }
     public void searchForFilm(String searchedFilm)
    {
        for(Show currentShow : shows){
            if(searchedFilm.equals(currentShow.getTitle())){
                currentShow.displayDetails();
             
            }
        }
    }
    
   public boolean getEnableStart(){
       return enableStart;
   }
   public void getDetailsForFill()
   {
       enableStart = true;
       startHour = 11;
       Scanner inputScanner = new Scanner(System.in);
       while(enableStart == true){
           
           System.out.print("Current Start Hour: ");
           System.out.println(startHour);
           
           System.out.println("Please Enter The Name Of The Film");
           System.out.print(">");
           String title = inputScanner.nextLine();
           title = inputScanner.nextLine();
           
           System.out.println("Please Enter The Director Of The Film");
           System.out.print(">");
           String director = inputScanner.nextLine();
           
           System.out.println("Please Enter The Release Year Of The Film");
           System.out.print(">");
           int releaseYear = inputScanner.nextInt();
           
           System.out.println("Please Enter The Duration (in minutes) Of The Film");
           System.out.print(">");
           int duration = inputScanner.nextInt();
           
           this.manualFill(title, director, releaseYear, duration);
       }
           
   }
   private void manualFill(String title, String director, int releaseYear, int duration)
   {
       
       if( (startHour >= 22) ){
               enableStart = false;
           }
       Show currentShow = new Show(title, director, releaseYear, duration, startHour);
       if(((startHour + currentShow.getFilmDuration()) <= 23) && ((int)currentShow.getFilmDuration() > 1)){
           enableStart = true;
           this.addShow(currentShow);
           int lenghtOfFilm = (int)currentShow.getFilmDuration();
           startHour = (startHour + lenghtOfFilm);
       }
       
   }
    
   
   public void bookSeat(int co, int ro, int showStart)
   {
       boolean seatValdata = false;
       
       for(Show currentShow : shows){
           if(showStart == currentShow.getStartTime()){
               currentShow.bookSeat(co, ro);
               seatValdata = true;
            }
            
       }
       if(seatValdata == false){
                System.out.println("You have entered a wrong time, please try again");
           }
   }
   
   public void unBookSeat(int co, int ro, int showStart)
   {
       for(Show currentShow: shows){
           if(showStart == currentShow.getStartTime()){
               currentShow.unBookSeat(co,ro);
            }
        }
    }
    
    public  boolean checkSeatIsBooked(int co, int ro, int showStart)
     {
       boolean isBooked = false;
         for(Show currentShow: shows){
           if(showStart == currentShow.getStartTime()){
               isBooked =currentShow.seatIsBooked(co, ro);
            }
        }
        return isBooked;
    }

}
