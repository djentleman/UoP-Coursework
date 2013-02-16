/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
package boxodering;

/**
 *
 * @author U AMD
 */
public class BoxI extends Box {
    
    public BoxI(){} //default constructor
    
    public BoxI(int grade, double height, double width, double depth, boolean isSealable){
        super(grade, height, width, depth, isSealable);
        id = 1;
    }
    
    public double getMultiplier(){
        //no subclass method calls means no carrying on, and no need to exit the class, hence private
        double multiplier;
        if(isSealable){
            multiplier = 5; //5% for sealable
        }
        else{
            multiplier = 0; // no extras, no multiplier
        }
        multiplier = 1 + (multiplier / 100); //changes multiplier to percent form
        return multiplier;
    }
    
}
