import java.util.ArrayList;
import java.io.*;
import java.util.StringTokenizer;
import java.lang.Math;
/**
 * Class Show represents a single showing of a film. The show will 
 * have a start time and a duration. This prototype produces the
 * same schedule for all days so days do not need to be represented.
 * 
 * @author Robert Topp 
 * @version 27/02/12
 */
public class Show
{
    private ArrayList<Seat> seats;
    private int startHour;
    private Film film;
    private CreateFilmArray array;
    

    /**
     * Constructor for objects of class Show
     */
    public Show(int startHour) throws FileNotFoundException
    {
        seats = new ArrayList<Seat>();
        array = new CreateFilmArray();
        this.film = array.getRandomFilm();
        this.startHour = startHour;

    }
    /**
     * this contructor is used to manually fill schedules
     */
    public Show(String title, String director, int releaseYear, int duration, int startHour)
    {
        this.film = new Film(title, director, releaseYear, duration);
        this.startHour = startHour;
    }
    
    public void updateShowTime()
    {
        // to be completed
    }
    
    public void updateScreenDetails()
    {
        // to be completed
    }
    public void displayDetails()
    {
        System.out.print("Title: ");
        System.out.print(film.getTitle());
        System.out.print("    Director: ");
        System.out.print(film.getDirector());
        System.out.print("    Release Year: ");
        System.out.print(film.getReleaseYear());
        System.out.print("   Duration: ");
        System.out.print(film.getDuration());
        System.out.print(" mins.  ");
        System.out.print("    Start Time: ");
        System.out.print(this.startHour);
        System.out.print(":00");
        System.out.println("");
    }

    public Film getFilmDetails()
    {
        return null;
    }
    public String getTitle()
    {
        return film.getTitle();
    }
    public double getFilmDuration()
    {
        double duration = ((this.film.getDuration() + 20) / 60);
        duration = Math.ceil(duration + 0.5);
        //System.out.println(duration);
        return duration;
    }
    public int getStartTime()
    {
        return this.startHour;
    }
    
    public void bookSeat(int co, int ro)
    {
      
           boolean seatValdata = false;
        for(Seat currentSeat: seats){
            if((currentSeat.getIsBooked() == true) && (currentSeat.getRo() == ro) && (currentSeat.getCo() == co)){
                System.out.println("You cannot book these seats, these have been booked before");
             seatValdata = true;
                
            }
        }
            
        if (seatValdata == false){  
        Seat newSeat = (new Seat(co, ro));
        seats.add(newSeat);
        newSeat.book();
 
    }
        }
       
        
    
    
    public void unBookSeat(int co, int ro)
    {
        for(Seat currentSeat: seats){
            if((currentSeat.getCo() == co) && (currentSeat.getRo() == ro)){
        currentSeat.unBook();
    }
    }
}

    public boolean seatIsBooked(int co,int ro)
    {
       boolean seatBooked = false;
        
         for(Seat currentSeat: seats){
            if((currentSeat.getCo() == co) && (currentSeat.getRo() == ro)){
                seatBooked = currentSeat.getIsBooked();
            }
            
             
    }
    return seatBooked;
    }
}
