import java.util.Scanner;
import java.io.*;
import java.util.StringTokenizer;
import java.util.Random;
/**
 * Write a description of class CreateScreenArray here.
 * 
 * @author (your name) 
 * @version (a version number or a date)
 * 
 * create a array of screens to be read from a txt file
 */

public class CreateScreenArray
{
    // instance variables - replace the example below with your own
    private Screen[] screenstxt = new Screen[4];

    /**
     * Constructor for objects of class CreateScreenArray
     */
    public CreateScreenArray()
    {
        // initialise instance variables
     
    }

   
    
    /**
    * createTop1000() returns an array containing the screens
    */
   private Screen[] createScreen() throws FileNotFoundException 
   {
      int screenId;
      int screenWidth;
      int screenHeight;
      String isThreeD;
      File datafile = new File("screenstxt.txt");
      Scanner scan = new Scanner(datafile);
      int index = 0;
      do
      {
        String sentence = scan.nextLine();
        String delimiter = ",\n";
        StringTokenizer tokens = new StringTokenizer(sentence, delimiter);
        screenId = Integer.parseInt(tokens.nextToken());
        screenWidth = Integer.parseInt(tokens.nextToken());
        screenHeight = Integer.parseInt(tokens.nextToken());
        isThreeD = tokens.nextToken();
        screenstxt[index] = new Screen(screenId,screenWidth, screenHeight, isThreeD);
        index++;
      } while(scan.hasNext());
      return screenstxt;
   }
   public Screen getScreen(int index)throws FileNotFoundException 
   {
        this.createScreen();
     
        //System.out.println(top1000[index].getTitle());
        return screenstxt[index];
   }
}
