
/**
 * Class Film models a film that may be shown. Films have a title, a director, 
 * a year of release and a duration in minutes. Note this class needs standard 
 * commenting added.
 * 
 * @author Robert Topp
 * @version 27/02/12
 */
public class Film
{

    private String title;
    private String director;
    private int releaseYear;  // a year e.g. 2006 or 1945
    private int duration;     // in minutes

    /**
     * Constructor for objects of class Film
     */
    public Film(String title, String director, int releaseYear, int duration)
    {
        this.title = title;
        this.director = director;
        this.releaseYear = releaseYear;
        this.duration = duration;
    }

    /**
     * Accessor methods
     */
    public String getTitle()
    {
        return title;
    }
    
    public String getDirector()
    {
        return director;
    }
    
    public int getReleaseYear()
    {
        return releaseYear;
    }
    
    public int getDuration()
    {
        return duration;
    }
}
