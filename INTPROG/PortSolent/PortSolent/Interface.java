import java.util.Scanner;
import java.io.*;
import java.util.StringTokenizer;
/**
 * This class contains the text-based interface with which the user will 
 * buy tickets, view cinema schedules and book seats. 
 * 
 * @author Craig Wilson, Todd Perry, Sam Borni 
 * @version 15/03/2012
 */
public class Interface
{
    private boolean quit = false;
    private Cinema newCinema;
    
    public  Interface()
    {
        
    }
   
    /**
     *Prints a welcome message in the terminal window upon starting the program.
     */
    private void welcome()
    {
        System.out.println("#############");
        System.out.println("#    PORT   #");
        System.out.println("#   SOLENT  #");
        System.out.println("#############");
        System.out.println("");
        System.out.println("#############################################################");
        System.out.println("");
    }
        
    /**
     * The main menu appears in the terminal window with which the user selects an option. 
     * Depending on the selected number, the program will perform a different task.
     */
    private void menuSystem() throws FileNotFoundException 
    {
        int initialNumber = 0;
        Scanner inputScanner = new Scanner(System.in);
        System.out.println("Please Enter Your Selection");
        System.out.println("'0' = Help Menu");
        System.out.println("'1' = View Full Cinema Schedule");
        System.out.println("'2' = Find Scheduled Viewings Of A Film");
        System.out.println("'3' = View Selected Screen Schedule");
        System.out.println("'4' = Manually Fill A Schedule");
        System.out.println("'7' = Book Seat");
        System.out.println("'8' = UnBook Seat");
        System.out.println("'9' = Screen layout");
        System.out.println("'10' = Seats left");
        System.out.println("'11' = Group Booking");
        System.out.println("'99' = Quit");
        System.out.print(">");
        initialNumber = inputScanner.nextInt();
        if(initialNumber == 0){
            this.help();
        }
        else if(initialNumber == 1){
            this.displayCinemaSchedule();
        }
        else if(initialNumber == 2){
            this.search();
        }
        else if(initialNumber == 3){
            this.displaySelectedSchedule();
        }
        else if(initialNumber == 4){
            this.clearScreen();
        }
        else if(initialNumber == 7){
            this.bookSeat();
        }
        
        else if(initialNumber == 8){
            this.unBookSeat();
        }
        else if(initialNumber == 9){
            this.printScreenLayout();
        }
        
        else if(initialNumber == 10){
            this.seatsLeft();
        }
        else if(initialNumber == 11){
            this.groupBook();
        }
        else if(initialNumber == 99)
        {
            this.quit = true;
        }
        else{
            System.out.println("invalid command, please try again");
        }
    }
    
    /**
     * Displays the full cinema schedule, screen by screen.
     */
    
    private void clearScreen() throws FileNotFoundException
    {
        int userChoice = -1;
        int screenNo = 0;
        boolean endLoop = false;
        Scanner inputScanner = new Scanner(System.in);
        while(endLoop == false){
            System.out.println("Please Enter The Screen Number You Want To Manually Create");
            System.out.print(">");
            userChoice = inputScanner.nextInt();
            if(userChoice > 4 || userChoice < 0){
                System.out.println("invalid screen, try again");
            }
            else{
                screenNo = userChoice - 1;
                endLoop = true;
            }
        }
        newCinema.clearScreen(screenNo);
        newCinema.manuallyFillSchedule(screenNo);
        
    }
    
    
    private void displayCinemaSchedule() throws FileNotFoundException 
    {
        for(int screenNumber = 1; screenNumber < (newCinema.getNoOfScreens() + 1); screenNumber++){
            newCinema.displayCinemaSchedule(screenNumber);
        }
    }
    private void groupBook()
    {
        Scanner inputScanner = new Scanner(System.in);
        System.out.println("enter the amount of people in your group");
        System.out.print(">");
        int groupSize = inputScanner.nextInt();
        System.out.println("enter the screen you want to book seats on");
        System.out.print(">");
        int screenNo = inputScanner.nextInt();
        System.out.println("enter the time you're film starts");
        System.out.print(">");
        int startTime = inputScanner.nextInt();
        newCinema.bookGroupSeats(groupSize, screenNo, startTime);
        
    }
    private void bookSeat()
    {
        Scanner sc = new Scanner(System.in);
        System.out.println("enter collumn number:");
        System.out.print(">");
        int ro = sc.nextInt();
        System.out.println("enter row number:");
        System.out.print(">");
        int co = sc.nextInt();
        System.out.println("enter screen:");
        System.out.print(">");
        int screen = sc.nextInt();
        System.out.println("when does you're film start?:");
        System.out.print(">");
        int startTime = sc.nextInt();
       
      
     
        newCinema.bookSeat(ro, co, startTime, screen);
        
       
 
        
        
        
        
    }
    
      private void unBookSeat()
    {
        Scanner sc = new Scanner(System.in);
        System.out.println("enter collumn number:");
        System.out.print(">");
        int ro = sc.nextInt();
        System.out.println("enter row number:");
        System.out.print(">");
        int co = sc.nextInt();
        System.out.println("enter screen:");
        System.out.print(">");
        int screen = sc.nextInt();
        System.out.println("when does you're film start?:");
        System.out.print(">");
        int startTime = sc.nextInt();
       
      
       System.out.println("You have unbooked the seat");
       newCinema.unBookSeat(ro, co, startTime, screen);
        
       
 
        
        
        
        
    }
    
    private void printScreenLayout()
    {
        Scanner sc = new Scanner(System.in);
        System.out.println("Type in the screen number you want to check the floor plan for:");
        System.out.print(">");
        int screenID = sc.nextInt();
        
         System.out.println("when does you're film start?:");
        System.out.print(">");
        int startTime = sc.nextInt();
        
        newCinema.printSeatLayout(screenID, startTime);
    }
    
    private void seatsLeft()
    {
      Scanner sc = new Scanner(System.in);
        System.out.println("Type in the screen number you want to check how many spaces are left:");
        System.out.print(">");
        int screenID = sc.nextInt();
        
         System.out.println("when does you're film start?:");
        System.out.print(">");
        int startTime = sc.nextInt();
        
        int seatsLeft=newCinema.getSeatsLeft(screenID,startTime);
        System.out.println("There are " + seatsLeft + " seatsLeft for that show");
    }
        

    /**
     * Displays the film schedule for a specific, user-selected screen in the terminal window.
     */
    private void displaySelectedSchedule() throws FileNotFoundException 
    {
        int screenNumber = 0;
        Scanner inputScanner = new Scanner(System.in);
        System.out.println("Please Enter The Screen Number (1 to 4)");
        System.out.print(">");
        screenNumber = inputScanner.nextInt();
        newCinema.displayCinemaSchedule(screenNumber);
    }
    
    
    
    /**
     * Displays the help menu in the terminal window.
     */
    private void help()
    {
        System.out.println("to operate this menu system you must read the instructions given");
        System.out.println("to make a choice, you enter a number, you can choose from the numbers");
        System.out.println("given to access the said function.");
        System.out.println("");
        System.out.println("The current builds functions are as follows, 0: help, 9: quit");
    }
    
    /**
     *The schedules will be between 11am and 11pm.
     *------------------------------
     *NEEDS CHANGING TO 11-11 
     *------------------------------
     */
    private void autoCreate() throws FileNotFoundException 
    {
        newCinema = new Cinema();
    }
    
    /**
     * Initialises the software and prints the welcome message. While the user does not
     * quit the software, this displays the main menu in the terminal window.
     */
    public void run() throws FileNotFoundException 
    {
        this.welcome();
        this.autoCreate();
        while(quit != true){
            this.menuSystem(); 
        }
        System.out.println("Thank you for using our software");
    }
    
    
    
    
    private void search() throws FileNotFoundException
    {
        String i = "";
        Scanner sc = new Scanner(System.in);
        System.out.println("enter a film to search:");
        System.out.print(">");
       
   
        
        i = sc.nextLine();
        System.out.println("searhing for" + i);
        newCinema.searchFilm(i);
    }
    
    
    
    
}
