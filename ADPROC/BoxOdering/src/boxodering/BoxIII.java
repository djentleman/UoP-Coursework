/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package boxodering;

/**
 *
 * @author U AMD
 */
public class BoxIII extends BoxII{
    
    protected String col2;
    
    public BoxIII(){} //default constructor
    
    public BoxIII(int grade, double height, double width, double depth, boolean isSealable, String col1, String col2){
        super(grade, height, width, depth, isSealable, col1);
        this.col2 = col2;
        id = 3;
    }
    


    
    public void setCol2(String col){
        col2 = col;
    }
    
    public String getCol2(){
        return col2;
    }
    
    protected double getMultiplier(double currentMultiplier){ 
        //protected, as this method will only be called by sub classes
        double multiplier = super.getMultiplier(currentMultiplier + 15);
        // doesn't need to be changed to perfect form, as it's being fed down to superclasses
        return multiplier;
    }
    
    public double getMultiplier(){
        //method is called from external processes, so public
        double multiplier = super.getMultiplier(15);
        multiplier = 1 + (multiplier / 100); //changes to percent form
        return multiplier;
    }
}
