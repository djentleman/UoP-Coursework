
import java.util.Scanner;
import java.io.*;
import java.util.StringTokenizer;
import java.util.Random;
/**
 * CreateFilmArray contains two methods each of which
 * creates an array of Film objects by reading from a
 * text file and returns the array to the calling code.
 * The text files need to be in the BlueJ project directory.
 * Commenting of this class is not complete.
 * @author Robert topp
 * @version 27/02/12
 */

public class CreateFilmArray
{
   private Film[] top1000 = new Film[1000];
   private Random randGen;
   
   
   public CreateFilmArray()
   {
       randGen = new Random();
   }

   /**
    * createTop1000() returns an array containing the top 1000 films
    * of all time.
    */
   private Film[] createTop1000() throws FileNotFoundException 
   {
      String title;
      String director;
      int year;
      int duration;
      File datafile = new File("top1000films.txt");
      Scanner scan = new Scanner(datafile);
      int index = 0;
      do
      {
        String sentence = scan.nextLine();
        String delimiter = ",\n";
        StringTokenizer tokens = new StringTokenizer(sentence, delimiter);
        title = tokens.nextToken();
        director = tokens.nextToken();
        year = Integer.parseInt(tokens.nextToken());
        duration = Integer.parseInt(tokens.nextToken());
        top1000[index] = new Film(title,director,year,duration);
        index++;
      } while(scan.hasNext());
      return top1000;
   }
   public Film getRandomFilm()throws FileNotFoundException 
   {
        this.createTop1000();
        int index = randGen.nextInt(999);
        //System.out.println(top1000[index].getTitle());
        return top1000[index];
   }
    
    
}